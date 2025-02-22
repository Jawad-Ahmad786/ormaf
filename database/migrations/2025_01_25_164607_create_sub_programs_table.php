<?php

use App\Models\Program;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Program::class)->constrained()->cascadeOnDelete();
            $table->foreignId('manager_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->integer('branch_id');
            $table->integer('whole_of_govt_id');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('value');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('sub_programs');
    }
};
