<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturesSeeder extends Seeder
{
    public function run()
    {
        // Insert Features
        $features = [
            ['name' => 'User Accounts'],
            ['name' => 'Projects Limit'],
            ['name' => 'Department Limit'],
            ['name' => '24/7 Support'],
            ['name' => 'Custom Reports'],
            ['name' => 'Unlimited Storage'],
        ];

        foreach ($features as $feature) {
            DB::table('features')->insert([
                'name' => $feature['name'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Get plan IDs dynamically
        $plans = DB::table('plans')->pluck('id', 'name');

        // Insert Plan Features
        $planFeatures = [
            // Basic Plan
            ['plan_id' => $plans['Basic'], 'feature_id' => 1, 'value' => '1 User Account'],
            ['plan_id' => $plans['Basic'], 'feature_id' => 2, 'value' => 'Upto 3 Projects'],
            ['plan_id' => $plans['Basic'], 'feature_id' => 3, 'value' => 'Within 1 Department'],
            ['plan_id' => $plans['Basic'], 'feature_id' => 4, 'value' => 'No'],
            ['plan_id' => $plans['Basic'], 'feature_id' => 5, 'value' => 'No'],
            ['plan_id' => $plans['Basic'], 'feature_id' => 6, 'value' => 'No'],

            // Standard Plan
            ['plan_id' => $plans['Standard'], 'feature_id' => 1, 'value' => '3 User Accounts'],
            ['plan_id' => $plans['Standard'], 'feature_id' => 2, 'value' => 'Upto 3 Projects'],
            ['plan_id' => $plans['Standard'], 'feature_id' => 3, 'value' => 'Within 1 Department'],
            ['plan_id' => $plans['Standard'], 'feature_id' => 4, 'value' => 'Yes'],
            ['plan_id' => $plans['Standard'], 'feature_id' => 5, 'value' => 'No'],
            ['plan_id' => $plans['Standard'], 'feature_id' => 6, 'value' => 'No'],

            // Premium Plan
            ['plan_id' => $plans['Premium'], 'feature_id' => 1, 'value' => '9 User Accounts'],
            ['plan_id' => $plans['Premium'], 'feature_id' => 2, 'value' => 'Upto 3 Projects'],
            ['plan_id' => $plans['Premium'], 'feature_id' => 3, 'value' => 'Within 3 Departments'],
            ['plan_id' => $plans['Premium'], 'feature_id' => 4, 'value' => 'Yes'],
            ['plan_id' => $plans['Premium'], 'feature_id' => 5, 'value' => 'Yes'],
            ['plan_id' => $plans['Premium'], 'feature_id' => 6, 'value' => 'Yes'],
        ];

        DB::table('plan_features')->insert($planFeatures);
    }
}
