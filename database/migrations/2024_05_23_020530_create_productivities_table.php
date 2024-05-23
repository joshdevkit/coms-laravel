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
        Schema::create('productivities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('projectId');
            $table->string('subject');
            $table->string('description');
            $table->date('added_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->float('time_rendered');
            $table->foreign('task_id')->references('id')->on('task_lists');
            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('projectId')->references('id')->on('project_lists');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productivities');
    }
};
