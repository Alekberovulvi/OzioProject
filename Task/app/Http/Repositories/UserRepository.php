<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository 
{
    public $query;

    public function __construct()
    {
        $this->query = User::query();
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
