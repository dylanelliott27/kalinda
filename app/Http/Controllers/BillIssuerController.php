<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillIssuerRequest;
use App\Http\Requests\UpdateBillIssuerRequest;
use App\Models\BillIssuer;

class BillIssuerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BillIssuer::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillIssuerRequest $request)
    {
        $issuer = new BillIssuer();
        $issuer->name = request()->get("name");
        $issuer->save();

        return $issuer;
    }

    /**
     * Display the specified resource.
     */
    public function show(BillIssuer $billIssuer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillIssuer $billIssuer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillIssuerRequest $request, BillIssuer $billIssuer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillIssuer $billIssuer)
    {
        //
    }
}
