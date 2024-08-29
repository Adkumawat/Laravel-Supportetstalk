<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listners', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->string('age');
			$table->string('gender');
			$table->string('title')->nullable();
			$table->string('listner_bio')->nullable();
			$table->string('bio')->nullable();
			$table->string('language')->nullable();
			$table->string('interest')->nullable();
			$table->string('charges')->nullable();
			$table->string('image')->nullable();
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
        Schema::dropIfExists('listners');
    }
}
