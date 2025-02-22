<?php

use App\Models\Department;
use App\Models\Program;
use App\Models\SubProgram;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logic_models', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Program::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SubProgram::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('logic_models');
    }
};
