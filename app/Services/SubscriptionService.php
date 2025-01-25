<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Subscription;

class SubscriptionService {

    public function store(int $userId): Subscription
     {

        return Subscription::create([
                'user_id' => $userId,
                'module_id' => 1,
                'start_time' => Carbon::now(),
                'end_time' => Carbon::now()->addDays(7),
                'years' => 1,
                'status' => 'pending',
                'pending_extend_years' => 1,
                'user_craete_limits' => 3,
                'free_trial' => 1,
        ]);

    }

}
