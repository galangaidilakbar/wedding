<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAddressRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAddressRequest $request): RedirectResponse
    {
        $request->user()->addresses()->create($request->all());

        return to_route('profile.edit')->with('address-status', 'Alamat berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @return Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @return View
     */
    public function edit(Address $address): View
    {
        return view('address.edit', ['address' => $address]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAddressRequest $request
     * @param Address $address
     * @return RedirectResponse
     */
    public function update(StoreAddressRequest $request, Address $address): RedirectResponse
    {
        $address->update($request->all());

        return to_route('profile.edit')->with('address-status', 'Alamat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return RedirectResponse
     */
    public function destroy(Address $address): RedirectResponse
    {
        $address->delete();

        return to_route('profile.edit')->with('address-status', 'Alamat berhasil dihapus.');
    }
}
