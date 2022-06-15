<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_messages', function (Blueprint $table) {
            $table->id();
            $table->mediumText("content");
            $table->date("createAt");
            $table->date("sendAt");
            $table->boolean("discordSuccess");
            $table->boolean("slackSuccess");
            $table->longText("discordError")->nullable();
            $table->longText("slackError")->nullable();
            $table->foreignId("user_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_messages');
    }
}
