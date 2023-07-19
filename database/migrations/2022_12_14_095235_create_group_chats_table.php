<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_sub_group_id')->nullable();
            $table->foreign('school_sub_group_id')->references('id')->on('school_sub_groups')->cascadeOnDelete();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('sender_id');
            $table->longText('message')->nullable();
            $table->longText('meeting_id')->nullable();
            $table->longText('start_url')->nullable();
            $table->longText('join_url')->nullable();
            $table->integer('type')->comment('1=message, 2=audio, 3=video, 4=zoom, 5=document');
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
        Schema::dropIfExists('group_chats');
    }
}
