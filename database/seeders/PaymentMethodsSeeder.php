<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'Stripe'],
            ['name' => 'Paypal'],
            ['name' => 'Invoice']
        ];
        foreach ($paymentMethods as $method) {
            PaymentMethod::create([
                'name' => $method['name']
            ]);
        }
    }
}
