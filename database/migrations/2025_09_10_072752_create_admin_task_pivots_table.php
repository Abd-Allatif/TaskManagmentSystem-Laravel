<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_task_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignId("task_id")->constrained("tasks","id")->onDelete('cascade');
            $table->foreignId("admin_id")->constrained("admins","id")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_task_pivots');
    }
};
