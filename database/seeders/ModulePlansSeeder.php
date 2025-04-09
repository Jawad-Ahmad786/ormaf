<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulePlansSeeder extends Seeder
{
    public function run(): void
    {
        $modules = Module::all();
        $plans = Plan::all();

        // Define your specific prices here (adjust to your needs)
        $prices = [
            'Performance Management' => [
                'Basic' => 100,
                'Standard' => 1000,
                'Premium' => 10000
            ],
            'Risk Management' => [
                'Basic' => 200,
                'Standard' => 2000,
                'Premium' => 20000
            ],
            'Audit Planning' => [
                'Basic' => 300,
                'Standard' => 3000,
                'Premium' => 30000
            ],
        ];

        foreach ($modules as $module) {
            foreach ($plans as $plan) {
                // Get the price based on module and plan names
                $price = $prices[$module->name][$plan->name];

                // Attach the plan to the module with the price
                DB::table('module_plans')->insert([
                    'module_id' => $module->id,
                    'plan_id' => $plan->id,
                    'price' => $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
