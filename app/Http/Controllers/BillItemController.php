<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillItemRequest;
use App\Http\Requests\UpdateBillItemRequest;
use App\Models\BillItem;
use Illuminate\Support\Facades\Log;

class BillItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillItemRequest $request)
    {
        return BillItem::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(BillItem $billItem)
    {
        return $billItem;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillItem $billItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillItemRequest $request, BillItem $billItem)
    {
        Log::error($billItem);
        $billItem->update($request->validated());

        return $billItem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillItem $billItem)
    {
        $billItem->delete();

        return response(null, 200);
    }
}
