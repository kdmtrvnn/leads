<?php

namespace App\Repositories;

use App\Models\Lead;
use App\Models\Status;
use App\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Http\Request;

class LeadRepository implements LeadRepositoryInterface
{
    public function get()
    {
        return Lead::get();
    }

    public function countAllLeads(): int
    {
        return Lead::count();
    }

    public function countLeadsInStatusNew(): int
    {
        $status = Status::where('name', Status::STATUS_NEW)->first();
        if ($status) {
            return Lead::where('status_id', $status->id)->count();
        }
    }

    public function countLeadsInStatusAtWork(): int
    {
        $status = Status::where('name', Status::STATUS_AT_WORK)->first();
        if ($status) {
            return Lead::where('status_id', $status->id)->count();
        }
    }

    public function countLeadsInStatusCompleted(): int
    {
        $status = Status::where('name', Status::STATUS_COMPLETED)->first();
        if ($status) {
            return Lead::where('status_id', $status->id)->count();
        }
    }

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

    public function delete(int $id): void
    {
        Lead::destroy($id);
    }

    public function updateStatus(int $id, string $status): void
    {
        dd($status);
        Lead::where('id', $id)->update(['status_id' => $status]);
    }

    public function update(int $id, Request $request): void
    {
        Lead::where('id', $id)->update([
            'name' => $request->lead['name'],
            'surname' => $request->lead['surname'],
            'phone' => $request->lead['phone'],
            'email' => $request->lead['email'],
        ]);
    }
}
