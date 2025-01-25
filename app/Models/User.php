<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public static function boot()
    {
        parent::boot();

        // Listen to the 'verified' event
        static::updated(function ($user) {
            if ($user->hasVerifiedEmail()) {
                // Update the related subscription when email is verified
                $user->subscription()->update([
                    'is_verified_user' => 1,
                ]);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'zip_code',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'terms_conditions'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function subscription() {
        return $this->hasOne(Subscription::class);
    }

    public function department() {
        return $this->hasOne(Department::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
    public function state() {
        return $this->belongsTo(State::class);
    }
    public function city() {
        return $this->belongsTo(City::class);
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
