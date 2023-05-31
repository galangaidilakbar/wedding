<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRescheduleRequest;
use App\Models\Order;
use App\Models\Reschedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RescheduleController extends Controller
{
    public function create(Order $order): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('reschedule.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRescheduleRequest $request, Order $order): RedirectResponse
    {
        // membuat reschedule
        $order->reschedule()->updateOrCreate(
            ['order_id' => $order->id],
            [
                'old_date' => $order->tanggal_acara,
                'new_date' => $request->new_date,
                'reason' => $request->reason,
                'status' => Reschedule::STATUS['PENDING'],
            ]
        );

        // membuat timeline
        $order->timelines()->create([
            'title' => 'Pengajuan reschedule dibuat.',
            'description' => 'Mengajukan reschedule dari tanggal '.$order->tanggal_acara->format('Y-m-d').' ke tanggal '.$request->new_date.' dengan alasan '.$request->reason.'.',
        ]);

        return redirect()->route('order.show', $order->id)->with('reschedule-success', 'Pengajuan reschedule berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, Reschedule $reschedule): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('reschedule.show', compact('order', 'reschedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order, Reschedule $reschedule): RedirectResponse
    {
        // update status reschedule
        $reschedule->update(['status' => $request->status]);

        // update tanggal acara jika status reschedule disetujui
        if ($request->status == Reschedule::STATUS['APPROVED']) {
            $order->update(['tanggal_acara' => $reschedule->new_date]);
        }

        // membuat timeline
        $order->timelines()->create([
            'title' => 'Pengajuan reschedule '.$reschedule->status.'.',
            'description' => 'Pengajuan reschedule '.$reschedule->status.' oleh Admin.',
        ]);

        return to_route('order.show', $order)->with('reschedule-success', 'Pengajuan reschedule berhasil '.$reschedule->status.'.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, Reschedule $reschedule): RedirectResponse
    {
        $reschedule->delete();

        return to_route('order.show', $order)->with('reschedule-success', 'Pengajuan reschedule berhasil dihapus.');
    }
}
