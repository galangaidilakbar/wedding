<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRescheduleRequest;
use App\Models\Order;
use App\Models\Reschedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RescheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('reschedule.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRescheduleRequest $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function store(StoreRescheduleRequest $request, Order $order)
    {
        // membuat reschedule
        $order->reschedule()->updateOrCreate(
            ['order_id' => $order->id],
            [
                'old_date' => $order->tanggal_acara,
                'new_date' => $request->new_date,
                'reason' => $request->reason,
            ]
        );

        // membuat timeline
        $order->timelines()->create([
            'title' => 'Pengajuan reschedule dibuat.',
            'description' => 'Mengajukan reschedule ke tanggal ' . $request->new_date . ' dengan alasan ' . $request->reason . '.',
        ]);

        return redirect()->route('order.show', $order->id)->with('reschedule-success', 'Pengajuan reschedule berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param Reschedule $reschedule
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, Reschedule $reschedule)
    {
        return view('reschedule.show', compact('order', 'reschedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Reschedule $reschedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Reschedule $reschedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Reschedule $reschedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, Reschedule $reschedule)
    {
        // update status reschedule
        $reschedule->update(['status' => $request->status]);

        // update tanggal acara jika status reschedule disetujui
        if ($request->status == Reschedule::STATUS['APPROVED']) {
            $order->update(['tanggal_acara' => $reschedule->new_date]);
        }

        // membuat timeline
        $order->timelines()->create([
            'title' => 'Pengajuan reschedule ' . $reschedule->status . '.',
            'description' => 'Pengajuan reschedule ' . $reschedule->status . ' oleh Admin.',
        ]);

        return to_route('order.show', $order)->with('reschedule-success', 'Pengajuan reschedule berhasil ' . $reschedule->status . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reschedule $reschedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reschedule $reschedule)
    {
        //
    }
}
