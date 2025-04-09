<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'plan_features')->withPivot('value');
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_plans')->withPivot('price');
    }
}
