<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_chat_reactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_chat_id')->nullable();
            $table->foreign('group_chat_id')->references('id')->on('group_chats')->cascadeOnDelete();
            $table->unsignedBigInteger('school_sub_group_id')->nullable();
            $table->foreign('school_sub_group_id')->references('id')->on('school_sub_groups')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('emoji');
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
        Schema::dropIfExists('group_chat_reactions');
    }
}
