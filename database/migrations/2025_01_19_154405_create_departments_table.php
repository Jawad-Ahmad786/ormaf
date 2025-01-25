<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('name');
            $table->string('abbrevation')->nullable();
            $table->string('logo')->nullable();
            $table->string('group_by');
            $table->integer('no_of_branches');
            $table->integer('no_of_obj');
            $table->integer('no_of_programs');
            $table->boolean('dep_pms_exist');
            $table->boolean('dep_rm_exist');
            $table->boolean('show_dep');
            $table->boolean('show_program');
            $table->boolean('show_subprogram');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
