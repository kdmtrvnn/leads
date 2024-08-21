<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\Interfaces\StatusRepositoryInterface;

class StatusRepository implements StatusRepositoryInterface
{
    public function get()
    {
        return Status::get();
    }
}
