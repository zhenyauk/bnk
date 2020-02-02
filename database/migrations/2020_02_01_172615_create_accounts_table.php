<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Account;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id')->unsigned();
            $table->tinyInteger('currency_id')->unsigned();
            $table->string('number');                                           // Номер счета
            $table->string('iban')->nullable();                                           // Номер счета
            $table->tinyInteger('personality')->unsigned();                     // Персонализация счета
            $table->tinyInteger('accounttype_id')->unsigned();                            // Тип счета
            $table->decimal('balance_current', 10, 2)->default(0);              // Текущий остаток
            $table->decimal('balance_available_min', 10, 2)->default(0);        // Минимальный доступный остаток
            $table->decimal('balance_available_current', 10, 2)->default(0);    // Доступный остаток
            $table->decimal('arrears', 10, 2)->default(0);                      // Просроченная задолженность
            $table->decimal('facility_rate', 4, 1)->default(0);                 // Процентная ставка за превышение лимита
            $table->dateTime('last_statement_date')->nullable();                // Дата последнего формирования выписок
            $table->dateTime('last_transaction_date')->nullable();

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
        Schema::dropIfExists('accounts');
    }
}
