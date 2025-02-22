<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    public static function boot()
    {
        parent::boot();

        static::updated(function ($user) {
            if ($user->hasVerifiedEmail()) {
                $user->subscription()->update([
                    'is_verified_user' => 1,
                ]);
            }
        });
    }

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
        'added_by',
        'terms_conditions',
        'image',
    ];

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
    public function programs() {
        return $this->hasMany(Program::class, 'manager_id');
    }
    public function subPrograms() {
        return $this->hasMany(SubProgram::class, 'manager_id');
    }
    public function programMembers() {
        return $this->belongsToMany(Program::class, 'program_members');
    }
    public function subprogramMembers() {
        return $this->belongsToMany(SubProgram::class, 'subprogram_members');
    }

    protected function image(): Attribute
{
    return Attribute::make(
        get: fn ($value) => asset('storage/' . $value),
    );
}

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
