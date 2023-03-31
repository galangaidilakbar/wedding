<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Response;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class CreateInvoiceController extends Controller
{
    /**
     * Return invoice
     *
     * @return Response
     * @throws Exception
     */
    public function index(Order $order): Response
    {
        $customer = new Buyer([
            'name' => request()->user()->name,
            'custom_fields' => [
                'email' => request()->user()->email,
            ],
        ]);

        $items = [];

        foreach ($order->detail_orders()->get() as $detail_order) {
            $items[] = (new InvoiceItem())->title($detail_order->product->name)->pricePerUnit($detail_order->product->price);
        }

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItems($items)
            ->logo(public_path('img/ginasty-logo.jpeg'));

        return $invoice->stream();
    }
}
