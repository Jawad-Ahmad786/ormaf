<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'user_id', 'name', 'abbrevation', 'logo', 'group_by', 'no_of_branches', 'no_of_obj', 'no_of_programs', 'no_of_programs', 'dep_pms_exist', 'dep_rm_exist', 'show_dep', 'show_program', 'show_subprogram'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function logicModel() {
        return $this->hasOne(LogicModel::class);
    }
}
