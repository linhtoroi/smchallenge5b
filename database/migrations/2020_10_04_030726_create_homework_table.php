<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->string('fileName');
            $table->timestamps();
            $table->increments('idHw');
        });
        Schema::table('homework', function (Blueprint $table) {
            
            $table->string('studentAccount');
            $table->foreign('studentAccount')->references('account')->on('student')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id',false, false)->unsigned();
            $table->foreign('id')->references('id')->on('exercise')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homework');
    }
}
