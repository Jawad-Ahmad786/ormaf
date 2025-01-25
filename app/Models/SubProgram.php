<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProgram extends Model
{
     protected $fillable = ['program_id', 'name'];

     public function program() {
        return $this->belongsTo(Program::class);
     }
}
