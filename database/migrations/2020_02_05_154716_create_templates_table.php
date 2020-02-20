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
            $table->string('name')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('iban')->nullable();;
            $table->string('payer_name')->nullable();
            $table->string('recipier_name')->nullable();
            $table->string('recipier_phone')->nullable();
            $table->string('country_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();;
            $table->string('bic_bank')->nullable();;
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
