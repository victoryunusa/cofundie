<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnschedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('return_type');//percentage or fixed
            $table->string('profit_type')->nullable(); // profit or loss
            $table->double('amount')->nullable();
            $table->string('attachment')->nullable();
            $table->date('return_date')->nullable();
            $table->boolean('status')->default(0); // 0 pending, 1 completed.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returnschedules');
    }
};
