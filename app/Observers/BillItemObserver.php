<?php

namespace App\Observers;

use App\Models\BillItem;

class BillItemObserver
{
    /**
     * Handle the BillItem "created" event.
     */
    public function created(BillItem $billItem): void
    {
        $billItem->bill->amount = bcadd($billItem->bill->amount, $billItem->amount);
    }

    /**
     * Handle the BillItem "updated" event.
     */
    public function updated(BillItem $billItem): void
    {
        $billItem->bill->amount = $billItem->bill->billItems->sum('amount');
    }

    /**
     * Handle the BillItem "deleted" event.
     */
    public function deleted(BillItem $billItem): void
    {
        $billItem->bill->amount = bcsub($billItem->bill->amount, $billItem->amount);
    }

    /**
     * Handle the BillItem "restored" event.
     */
    public function restored(BillItem $billItem): void
    {
        //
    }

    /**
     * Handle the BillItem "force deleted" event.
     */
    public function forceDeleted(BillItem $billItem): void
    {
        //
    }
}
