<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(string $locale, $priceId)
    {
        $quantity = 1;
        $user = User::where('email', 'test@user.com')->first();

        return $user->checkout([$priceId => $quantity], [
            'mode' => 'subscription', // Ensure subscription mode
            'success_url' => route('checkout.success', [app()->getLocale()]),
            'cancel_url' => route('checkout.cancel', [app()->getLocale()]),
        ]);
    }
    public function success()
    {
        dd('Successfully paid');
    }
    public function cancel()
    {
        dd('Payment Failed');
    }

}
