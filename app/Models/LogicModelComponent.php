<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogicModelComponent extends Model
{
    protected $fillable = ['logic_model_component_type_id', 'logic_model_id', 'name'];

    public function logicModel() {
        return $this->belongsTo(LogicModel::class);
    }
    public function lmComponentType() {
        return $this->hasMany(LogicModelComponentType::class);
    }
    public function program() {
        return $this->hasOne(Program::class);
    }
    public function subProgram() {
        return $this->hasOne(SubProgram::class);
    }
}
