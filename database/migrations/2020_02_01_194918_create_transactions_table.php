<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Transaction;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('type');                                     // IN OUT
            $table->decimal('amount', 10, 2);
            $table->text('details')->nullable();
            $table->text('description')->nullable();
            $table->decimal('balance', 10, 2);
            $table->tinyInteger('status')->default(Transaction::STATUS_NEW);


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
        Schema::dropIfExists('transactions');
    }
}
