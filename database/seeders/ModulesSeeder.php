<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{
    public function run()
    {
        $modules = [
            ['name' => 'Performance Management', 'active' => 1, 'description' => 'Performance Measurement Module for managers to track performance and develop strategies.'],
            ['name' => 'Risk Management', 'active' => 1, 'description' => 'Risk-based Evaluation Planning Module to prioritize Universe based on risk.'],
            ['name' => 'Audit Planning', 'active' => 1, 'description' => 'Risk-based Audit Planning Module for managers to develop multi-year risk-based Audit Plans.']
        ];

        foreach ($modules as $module) {
            DB::table('modules')->insert([
                'name' => $module['name'],
                'active' => $module['active'],
                'description' => $module['description'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
