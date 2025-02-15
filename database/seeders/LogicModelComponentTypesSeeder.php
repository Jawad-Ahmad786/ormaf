<?php

namespace Database\Seeders;

use App\Models\LogicModelComponentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogicModelComponentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LogicModelComponentType::create([
            'name' => 'objectives'
        ]);
    }
}
