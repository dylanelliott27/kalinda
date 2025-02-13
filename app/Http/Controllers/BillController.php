<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Models\BillItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Bill::paginate();
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
    public function store(StoreBillRequest $request)
    {
        $billData = $request->validated();

        Log::error($billData);

        DB::beginTransaction();

        try {
            $newBill = new Bill();
            $newBill->amount = 0;
            $newBill->due_date = $billData['due_date'];
            $newBill->save();

            $billSum = "0";

            foreach ($billData['bill_items'] as $billItem) {
                $newBillItem = new BillItem();
                $newBillItem->amount = $billItem['amount'];
                $newBillItem->bill_issuer_id = $billItem['bill_issuer_id'];
                $newBillItem->bill_id = $newBill->id;
                $newBillItem->save();

                $billSum = bcadd($billSum, $billItem['amount']);
            }

            $newBill->amount = $billSum;
            $newBill->save();

            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }

        return $newBill->load('billItems');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        return $bill->load('billItems.billIssuer');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $updateBillData = $request->validated();

        $bill->update($updateBillData);

        return $bill;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();

        return response(null, 200);
    }
}
