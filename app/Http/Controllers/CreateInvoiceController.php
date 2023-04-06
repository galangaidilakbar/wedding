<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class CreateInvoiceController extends Controller
{
    /**
     * Return invoice
     *
     * @param Order $order
     * @return Response
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function index(Order $order): Response
    {
        # Create seller
        $seller = new Party([
            'name' => config('app.name'),
            'address' => 'Dusun Sukasari, RT.09/RW.03, Kel. Sukajadi, Kec. Pamarican, Kab. Ciamis, Prov. Jawa Barat, 46382. https://maps.app.goo.gl/NxaXQ6HgT5TGzk4V9',
            'phone' => '+62 853-1431-4485',
        ]);

        # Create customer
        $customer = new Party([
            'name' => request()->user()->name,
            'address' => $order->address->detail . '(' . $order->address->patokan . ')',
            'phone' => $order->address->phone_number,
        ]);

        # Create items
        $items = [];
        foreach ($order->detail_orders()->get() as $detail_order) {
            $items[] = (new InvoiceItem())->title($detail_order->product->name)->pricePerUnit($detail_order->product->price);
        }

        # Create invoice
        $invoice = Invoice::make()
            ->status($order->status)
            ->sequence($order->id)
            ->date($order->created_at)
            ->seller($seller)
            ->buyer($customer)
            ->addItems($items)
            ->payUntilDays(3)
            ->logo(public_path('img/ginasty-logo.jpeg'));

        return $invoice->stream();
    }
}
