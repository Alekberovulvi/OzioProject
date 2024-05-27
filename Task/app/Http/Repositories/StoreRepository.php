<?php

namespace App\Http\Repositories;

use App\Models\Store;

class StoreRepository 
{
    public $query;

    public function __construct()
    {
        $this->query = Store::query();
    }

    public function all()
    {
        return $this->query->get();
    }

    public function find($field , $store_code)
    {
        return $this->query->where($field, $store_code)->first();
    }
}
