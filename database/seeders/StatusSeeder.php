<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Status::$statuses as $status) {
            if (!Status::where('name', $status)->exists()) {
                DB::table('statuses')->insert([
                    'name' => $status,
                ]);
            }
        }
    }
}
