<?php

namespace App\Http\Repositories;

use App\Models\SaleReceipt;

class ReceiptRepository 
{
    public $query;

    public function __construct()
    {
        $this->query = SaleReceipt::query();
    }

    public function all()
    {
        return $this->query->get();
    }

    public function find($id)
    {
        return $this->query->findOrFail($id);
    }
}
