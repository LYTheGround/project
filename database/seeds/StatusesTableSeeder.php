<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Statuses Seeder.
     *
     * @return void
     */
    public function run()
    {

        $statuses = ['inactive', 'active', 'archived'];

        foreach ($statuses as $status)

            Status::create(['status' => $status]);

    }
}
