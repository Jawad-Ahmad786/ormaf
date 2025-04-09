<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanFeaturesSeeder extends Seeder
{
    public function run(): void
    {
        // Define plans, their features, and corresponding values as seen in the image
        $planFeatures = [
            'Basic' => [
                'User Accounts' => '1',
                'Projects Limit' => '3',
                'Department Limit' => '1',
                '24/7 Support' => 'No',
                'Custom Reports' => 'No',
                'Unlimited Storage' => 'No',
            ],
            'Standard' => [
                'User Accounts' => '3',
                'Projects Limit' => '3',
                'Department Limit' => '1',
                '24/7 Support' => 'Yes',
                'Custom Reports' => 'No',
                'Unlimited Storage' => 'No',
            ],
            'Premium' => [
                'User Accounts' => '9',
                'Projects Limit' => '3',
                'Department Limit' => '3',
                '24/7 Support' => 'Yes',
                'Custom Reports' => 'Yes',
                'Unlimited Storage' => 'Yes',
            ]
        ];

        foreach ($planFeatures as $planName => $features) {
            // Get the plan ID
            $planId = DB::table('plans')->where('name', $planName)->value('id');

            if ($planId) {
                foreach ($features as $featureName => $value) {
                    // Get the feature ID
                    $featureId = DB::table('features')->where('name', $featureName)->value('id');

                    if ($featureId) {
                        // Insert into plan_features table with value
                        DB::table('plan_features')->insert([
                            'plan_id' => $planId,
                            'feature_id' => $featureId,
                            'value' => $value,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            }
        }
    }
}
