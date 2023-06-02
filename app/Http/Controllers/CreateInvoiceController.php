<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class CreateInvoiceController extends Controller
{
    /**
     * Return invoice
     *
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function index(Order $order): Response
    {
        $accepted_status = [
            Order::ORDER_STATUS['HAS_BEEN_PAID'],
            Order::ORDER_STATUS['HAS_BEEN_COMPLETED'],
        ];

        abort_if($order->status != in_array($order->status, $accepted_status), 403, 'Pesanan Belum Dibayar');

        // Create seller
        $seller = new Party([
            'name' => config('app.name'),
            'address' => 'Dusun Sukasari, RT.09/RW.03, Kel. Sukajadi, Kec. Pamarican, Kab. Ciamis, Prov. Jawa Barat, 46382. https://maps.app.goo.gl/NxaXQ6HgT5TGzk4V9',
            'phone' => '+62 853-1431-4485',
        ]);

        // Create customer
        $customer = new Party([
            'name' => request()->user()->name,
            'address' => $order->address->detail . '(' . $order->address->patokan . ')',
            'phone' => $order->address->phone_number,
        ]);

        // Create items
        $items = [];
        foreach ($order->detail_orders()->get() as $detail_order) {
            $items[] = (new InvoiceItem())->title($detail_order->product->name)->pricePerUnit($detail_order->product->price);
        }

        $notes = [
            'No. Pesanan: ' . $order->id,
            'Catatan dari Pembeli: ' . $order->note,
        ];

        $notes = implode('<br>', $notes);

        // Create invoice
        $invoice = Invoice::make()
            ->status($order->status)
            ->sequence($order->created_at->format('YmdHims'))
            ->date($order->created_at)
            ->seller($seller)
            ->buyer($customer)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('img/ginasty-logo.jpeg'));

        return $invoice->stream();
    }
}
