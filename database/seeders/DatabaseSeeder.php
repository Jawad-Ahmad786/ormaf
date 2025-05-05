<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
                LocationsSeeder::class,
                LogicModelComponentTypesSeeder::class,
                ModulesSeeder::class,
                ModuleItemsSeeder::class,
                PlansSeeder::class,
                PaymentMethodsSeeder::class,
                FeaturesSeeder::class,
                ModulePlansSeeder::class
        ]);

    }
}
