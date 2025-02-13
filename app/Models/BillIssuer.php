<?php

namespace App\Models;

use Database\Seeders\BillItemSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillIssuer extends Model
{
    /** @use HasFactory<\Database\Factories\BillIssuerFactory> */
    use HasFactory;

    public function billItems()
    {
        return $this->hasMany(BillItem::class);
    }
}
