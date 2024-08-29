<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_details', function (Blueprint $table) {
            $table->id();
			$table->Integer('user_id');
			$table->string('upi_id');
			$table->string('amount');
			$table->Integer('account_no');
			$table->string('ifsc_code');
			$table->string('bank_name');
			$table->string('transection_no');
			$table->string('status');
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
        Schema::dropIfExists('withdraw_details');
    }
}
