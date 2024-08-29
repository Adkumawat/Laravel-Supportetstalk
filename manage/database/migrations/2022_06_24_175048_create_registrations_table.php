<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
         $table->id();
			$table->string('name');
			$table->string('mobile_no');
			$table->string('helping_category')->nullable();
			$table->string('age')->nullable();
			$table->string('interest')->nullable();
			$table->string('language')->nullable();
			$table->string('sex')->nullable();
			$table->string('available_on')->nullable();
			$table->string('about')->nullable();
			$table->string('image')->nullable();
			$table->string('user_type');
			$table->status();
            $table->timestamps('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
