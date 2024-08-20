<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface LeadRepositoryInterface
{
    public function store(Request $request): void;
}
