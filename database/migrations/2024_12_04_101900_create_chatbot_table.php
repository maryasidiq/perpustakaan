<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatbotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatbot', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing
            $table->string('queries', 300); // varchar(300), not nullable
            $table->string('replies', 300); // varchar(300), not nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chatbot');
    }
}
