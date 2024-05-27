<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReceipt extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'cardno', 'bonus_card_no');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_code', 'store_code');
    }

    public function receiptItems()
    {
        return $this->hasMany(SaleReceiptItem::class, 'receipt_id', 'id');
    }
}
