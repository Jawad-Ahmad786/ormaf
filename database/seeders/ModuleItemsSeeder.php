<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleItemsSeeder extends Seeder
{
    public function run(): void
    {
        $moduleItems = [
            'Performance Management' => [
                'Performance Dashboard',
                'Linkages to Objectives',
                'Customized Logic Model',
                'Performance Indicators',
                'Timelines',
                'Accountabilities',
                'Performance Reporting'
            ],
            'Risk Management' => [
                'Risk Dashboard',
                'Linkages to Objectives',
                'Key Risk Areas',
                'Risk Indicators',
                'Timelines',
                'Accountabilities',
                'Risk Reporting'
            ],
            'Audit Planning' => [
                'Audit Universe',
                'Factor Risk Analysis',
                'Key Risk Areas',
                'Risk-Based Planning',
                'Timelines',
                'Accountabilities',
                'Audit Plans'
            ]
        ];

        foreach ($moduleItems as $moduleName => $items) {
            $moduleId = DB::table('modules')->where('name', $moduleName)->value('id');

            if ($moduleId) {
                foreach ($items as $item) {
                    DB::table('module_items')->insert([
                        'module_id' => $moduleId,
                        'name' => $item,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }
}
