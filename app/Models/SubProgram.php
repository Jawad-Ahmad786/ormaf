<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProgram extends Model
{
    protected $fillable = ['program_id', 'manager_id', 'logic_model_component_id', 'name', 'branch_id', 'whole_of_govt_id', 'start_date', 'end_date', 'value'];

     public function program() {
        return $this->belongsTo(Program::class);
     }
     public function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }
     public function members() {
         return $this->belongsToMany(User::class, 'subprogram_members');
    }
    public function logicModel() {
        return $this->hasOne(LogicModel::class);
    }
    public function logicModelComponent() {
        return $this->belongsTo(LogicModelComponent::class);
    }
}
