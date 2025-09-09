<?php

use Carbon\Carbon;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('create_date')->default(Carbon::now()->toDateTimeString());
            $table->date('deadline')->default(Carbon::now()->addDays(7)->toDateString());
            $table->unsignedTinyInteger('status')->default(0);
            $table->boolean('end_flag')->default(false);
            $table->foreignId('parentTask_id')->nullable()->constrained('tasks','id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
