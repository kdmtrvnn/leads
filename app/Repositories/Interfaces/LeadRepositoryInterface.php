<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface LeadRepositoryInterface
{
    public function get();
    public function countAllLeads(): int;
    public function countLeadsInStatusNew(): int;
    public function countLeadsInStatusAtWork(): int;
    public function countLeadsInStatusCompleted(): int;
    public function store(Request $request): void;

    public function delete(int $id): void;
    public function updateStatus(int $id, string $status): void;
    public function update(int $id, Request $request): void;
}
