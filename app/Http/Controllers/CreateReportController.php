<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

class CreateReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // get the order
        $orders = Order::with(['user', 'detail_orders', 'address'])->whereBetween('created_at', [$request->start_date, $request->end_date])->get();

        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada pesanan yang ditemukan.');
        }

        // convert order to array
        $collections = $orders->map(function ($order) {
            return [
                'No. Pesanan' => $order->id,
                'Tanggal Pesanan' => $order->created_at->toDateTimeString(),
                'Tanggal Acara' => $order->tanggal_acara->toDateString(),
                'Nama Pembeli' => $order->user->name,
                'Email Pembeli' => $order->user->email,
                'No. Telepon Pembeli' => $order->address->phone_number,
                'Detail Alamat Acara' => $order->address->full_name.' '.$order->address->detail.' ('.$order->address->patokan.')',
                'Opsi Bayar' => $order->opsi_bayar,
                'Metode Pembayaran' => $order->metode_pembayaran,
                'Status Pesanan' => $order->status,
                'Total Harga' => 'Rp.'.number_format($order->total_harga, 2, ',', '.'),
            ];
        });

        // return the report
        SimpleExcelWriter::streamDownload('laporan.xlsx')
            ->addRows($collections->toArray())
            ->toBrowser();

        return redirect()->back()->with('success', 'Laporan berhasil dibuat.');
    }
}
