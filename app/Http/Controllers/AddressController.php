<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AddressController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('profile.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request): RedirectResponse
    {
        $request->user()->addresses()->create($request->all());

        return to_route('profile.edit')->with('address-status', 'Alamat berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address): View
    {
        return view('profile.address.edit', ['address' => $address]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAddressRequest $request, Address $address): RedirectResponse
    {
        $address->update($request->all());

        return to_route('profile.edit')->with('address-status', 'Alamat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): RedirectResponse
    {
        $address->delete();

        return to_route('profile.edit')->with('address-status', 'Alamat berhasil dihapus.');
    }
}
