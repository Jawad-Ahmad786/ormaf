<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'module_id', 'start_time', 'end_time', 'years', 'pending_extend_years', 'free_trial', 'user_create_limits', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
