<?php

use App\Models\LogicModelComponent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
         Schema::table('sub_programs', function (Blueprint $table) {
            $table->foreignIdFor(LogicModelComponent::class)->after('manager_id')->constrained();
         });
    }
    public function down(): void
    {
        Schema::table('sub_programs', function (Blueprint $table) {
            $table->dropForeign(['logic_model_component_id']);
            $table->dropColumn('logic_model_component_id');
        });
    }
};
