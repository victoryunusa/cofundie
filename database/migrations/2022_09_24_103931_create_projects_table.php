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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('preview')->nullable();
            $table->string('invest_type'); //  0 fixed, 1 percentage,
            $table->boolean('capital_back'); // 0 no, 1 yes.
            $table->double('min_invest');
            $table->double('max_invest');
            $table->double('max_invest_amount');
            $table->boolean('is_period'); // 0 no, 1 yes.
            $table->string('period_duration')->nullable(); // monthly, yearly
            $table->string('profit_range')->nullable();
            $table->string('loss_range')->nullable();
            $table->boolean('status')->default(1); // 0 deactive, 1 active.
            $table->boolean('accept_new_investor')->default(1); // 0 No, 1 Yes.
            $table->boolean('accept_installments')->default(0); // 0 No, 1 Yes.
            $table->string('address')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
