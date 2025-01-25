<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $fillable = ['name', 'number', 'section_id', 'department_id', 'program_id', 'subprog_id', 'pms_exist', 'rm_exist', 'is_default'];

    public function department() {
        return $this->belongsTo(Department::class);
    }
    public function programs() {
        return $this->hasMany(Program::class);
    }
}
