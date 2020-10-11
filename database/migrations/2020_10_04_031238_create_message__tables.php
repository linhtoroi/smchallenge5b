<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->string('fileName');
            $table->timestamps();
        });
        Schema::table('message', function (Blueprint $table) {
            $table->string('accountSender');
            $table->foreign('accountSender')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('accountReceiver');
            $table->foreign('accountReceiver')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message__tables');
    }
}
