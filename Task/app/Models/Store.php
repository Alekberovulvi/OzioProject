<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Store extends Model
{
    use HasFactory;

    public function returnedSales($startDate = null, $endDate = null)
    {
        return $this->hasMany(SaleReceipt::class, 'store_code', 'store_code')
                    ->where('is_returned', 1)
                    ->when($startDate, function (Builder $query) use ($startDate) {
                        return $query->whereDate('sale_date', '>=', $startDate);
                    })
                    ->when($endDate, function (Builder $query) use ($endDate) {
                        return $query->whereDate('sale_date', '<=', $endDate);
                    });
    }

    public function nonReturnedSales($startDate = null, $endDate = null)
    {
        return $this->hasMany(SaleReceipt::class, 'store_code', 'store_code')
                    ->where('is_returned', 0)
                    ->when($startDate, function (Builder $query) use ($startDate) {
                        return $query->whereDate('sale_date', '>=', $startDate);
                    })
                    ->when($endDate, function (Builder $query) use ($endDate) {
                        return $query->whereDate('sale_date', '<=', $endDate);
                    });
    }
}