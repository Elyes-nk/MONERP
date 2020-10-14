<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplishippementRuleLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replishippement_rule_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('replishippement_rule_id');
            $table->foreignId('company_id');
            $table->foreignId('user_id');
            $table->date("date");
            $table->float("product_qty");
            $table->string("state");
            $table->string("message")->nullable();
            $table->foreignId('replishippement_order_id')->nullable();
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
        Schema::dropIfExists('replishippement_rule_lines');
    }
}
