<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['objective_id', 'user_id', 'name', 'branch_id', 'whole_of_govt_id', 'start_date', 'end_date', 'value', 'manager', 'parent'];

    public function objective() {
        return $this->belongsTo(Objective::class);
    }
    public function subPrograms() {
        return $this->hasMany(SubProgram::class);
    }
}
