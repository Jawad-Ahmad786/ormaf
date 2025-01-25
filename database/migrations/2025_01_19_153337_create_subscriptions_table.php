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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onCascadeDelete();
            $table->boolean('is_verified_user')->default(0);
            $table->string('module_id');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->integer('years')->default(1);
            $table->string('status');
            $table->boolean('pending_extend_years');
            $table->integer('user_create_limits')->default(3);
            $table->boolean('free_trial')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
