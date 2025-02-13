<?php

namespace App\Models;

use App\Observers\BillItemObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([BillItemObserver::class])]
class BillItem extends Model
{
    /** @use HasFactory<\Database\Factories\BillItemFactory> */
    use HasFactory;

    protected $fillable = ['amount', 'bill_issuer_id', 'bill_id'];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function billIssuer()
    {
        return $this->belongsTo(BillIssuer::class);
    }
}
