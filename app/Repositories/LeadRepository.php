<?php

namespace App\Repositories;

use App\Models\Lead;
use App\Models\Status;
use App\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Http\Request;

class LeadRepository implements LeadRepositoryInterface
{
    public function store(Request $request): void
    {
        $status = Status::where('name', Status::STATUS_NEW)->first();
        if ($status) {
            Lead::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'email' => $request->email,
                'text' => $request->text,
                'status_id' => $status->id,
            ]);
        }
    }
}
