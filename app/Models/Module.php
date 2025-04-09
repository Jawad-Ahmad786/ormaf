<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
     protected $fillable = ['name', 'active', 'description', 'price', 'program_manager_price', 'department_head_price', 'multi_department_analyst_price'];

     public function items()
     {
        return $this->hasMany(ModuleItem::class);
     }
     public function plans()
     {
        return $this->belongsToMany(Plan::class, 'module_plans')->withPivot('price');
     }
}
