<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogicModelComponentType extends Model
{
    protected $fillable = ['name'];

    public function lmComponent() {
        return $this->belongsTo(LogicModelComponent::class);
    }
}
