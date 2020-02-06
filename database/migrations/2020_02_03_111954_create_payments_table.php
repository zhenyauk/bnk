<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number')->nullable(); // Идентификационный номер
            $table->text('appointment')->nullable();
            // Детали платежа
            $table->string('payer_name')->nullable();
            $table->string('payer_phone')->nullable();
            $table->string('payer_country')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->integer('payer_currency_id')->nullable();
            $table->string('reference')->nullable();
            $table->integer('file')->nullable();
            $table->string('payer_bank')->nullable();


            // Получатель
            $table->integer('to_bill')->nullable();
            $table->string('recipier_name')->nullable();
            $table->string('recipier_phone')->nullable();
            $table->string('recipier_country')->nullable();
            $table->decimal('recipient_amount', 10, 2)->nullable();
            $table->integer('recipient_currency_id')->nullable();
            $table->string('recipier_bank')->nullable();
            $table->text('recipier_info')->nullable();
            // Комиссия
            $table->decimal('comission_amount', 10, 2)->nullable()->default(0);
            $table->integer('comission')->nullable()->default(1); // кто оплачивает комиссию


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
        Schema::dropIfExists('payments');
    }
}
