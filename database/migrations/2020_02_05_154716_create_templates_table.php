<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('to_bill');
            $table->string('recipier_name')->nullable();
            $table->string('recipier_phone')->nullable();
            $table->string('recipier_country')->nullable();
            $table->decimal('recipient_amount', 10, 2);
            $table->integer('recipient_currency_id');
            $table->string('recipier_bank')->nullable();
            $table->text('recipier_info')->nullable();
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
        Schema::dropIfExists('templates');
    }
}
