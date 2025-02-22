<?php

use App\Models\LogicModelComponentType;
use App\Models\LogicModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logic_model_components', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LogicModelComponentType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(LogicModel::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('logic_model_components');
    }
};
