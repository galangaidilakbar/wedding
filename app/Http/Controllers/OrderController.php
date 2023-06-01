<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\GetStatusColorOfAnOrder;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // get orders by user or admin
        $orders = request()->user()->isAdmin()
            ? Order::with('detail_orders.product')->latest()
            : request()->user()->orders()->with('detail_orders.product')->latest();

        // search order by id
        $orders->when(request()->has('search'), fn($query) => $query->where('id', request()->search));

        // filter order by status
        $orders->when(request()->has('status'), fn($query) => $query->where('status', request()->status));

        // filter order by date range
        if (request()->has('start') && request()->has('end')) {
            $orders->whereBetween('created_at', [
                Carbon::parse(request()->start)->toDateTimeString(),
                Carbon::parse(request()->end)->toDateTimeString(),
            ]);
        }

        return view('order.index', [
            'orders' => $orders->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     */
    public function create(CartService $cartService): View
    {
        $carts = $cartService->getCartOfUser(\request()->user());
        abort_if(
            $carts->isEmpty(),
            403,
            trans('translations.carts_is_empty')
        );

        return view('order.create', [
            'carts' => $carts,
            'addresses' => \request()->user()->addresses()->latest()->get(),
            'total_product_price' => $cartService->getTotalProductPrice($carts),
            'total_pembayaran_dengan_dp' => $cartService->getPriceInDP($cartService->getTotalProductPrice($carts)),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Exception
     */
    public function store(StoreOrderRequest $request, CartService $cartService): RedirectResponse
    {
        // Check availability
        $request->checkAvailability($request->input('tanggal_acara'));

        // validate request
        $validated = $request->validated();

        // get carts
        $carts = $cartService->getCartOfUser($request->user());
        $validated['total_harga'] = $cartService->getTotalProductPrice($carts);
        $validated['total_dp'] = $cartService->getPriceInDP($validated['total_harga']);

        // Create order
        $order = $request->user()->orders()->create($validated);

        // Create detail order and delete carts
        foreach ($carts as $cart) {
            $order->detail_orders()->create(['product_id' => $cart->product_id]);
            $cart->delete();
        }

        // Create timeline
        $order->timelines()->create(['title' => 'Pesanan Dibuat.']);

        $product_on_item_details = [];

        foreach ($order->detail_orders as $detail_order) {
            $product_on_item_details[] = [
                'id' => $detail_order->product->id,
                'price' => $detail_order->product->price,
                'quantity' => 1,
                'name' => $detail_order->product->name,
            ];
        }

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_harga,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
            'item_details' => $product_on_item_details,
        ];

        $snapToken = Snap::getSnapToken($params);

        $order->update([
            'snap_token' => $snapToken,
        ]);

        return to_route('order.show', $order)->with('snapToken', $snapToken);
    }

    /**
     * Display the specified resource.
     *
     * @throws AuthorizationException
     */
    public function show(Order $order): View
    {
        $this->authorize('view', $order);

        return view('order.show', ['order' => $order]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return to_route('order.index');
    }

    /**
     * Cancel order.
     */
    public function cancel(Request $request, Order $order, GetStatusColorOfAnOrder $statusColorOfAnOrder): RedirectResponse
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $order->update([
            'status' => Order::ORDER_STATUS['CANCELLED'],
            'status_color' => $statusColorOfAnOrder->get(Order::ORDER_STATUS['CANCELLED']),
        ]);

        $order->timelines()->create([
            'title' => 'Pesanan Dibatalkan.',
            'description' => 'Alasan pembatalan: ' . $request->input('description'),
        ]);

        return to_route('order.show', $order)->with('order-status', 'order-canceled');
    }
}
