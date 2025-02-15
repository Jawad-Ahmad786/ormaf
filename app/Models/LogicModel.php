<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogicModel extends Model
{
    protected $fillable = ['department_id', 'program_id', 'sub_program_id'];

    public function department() {
        return $this->belongsTo(Department::class);
    }
    public function lmComponents() {
        return $this->hasMany(LogicModelComponent::class);
    }
    public function program() {
        return $this->belongsTo(Program::class);
    }
}
