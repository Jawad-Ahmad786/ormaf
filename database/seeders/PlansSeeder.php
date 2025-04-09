<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [

                ['name' => 'Basic'],
                ['name' => 'Standard'],
                ['name' => 'Premium']
        ];


        foreach ($plans as $plan)
        {
            DB::table('plans')->insert([
                'name' => $plan['name'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
