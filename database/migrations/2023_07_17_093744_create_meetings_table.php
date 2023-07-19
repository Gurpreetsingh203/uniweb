<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('host_id')->nullable();
            $table->string('topic')->nullable();
            $table->text('description')->nullable();
            $table->string('type', 10)->nullable();
            $table->string('status')->nullable();
            $table->string('start_time')->nullable();
            $table->time('duration')->nullable();
            $table->string('timezone')->nullable();
            $table->text('start_url')->nullable();
            $table->string('join_url')->nullable();
            $table->string('password')->nullable();
            $table->string('encrypted_password')->nullable();
            $table->boolean('security')->default(0)->nullable();
            $table->boolean('host_video')->nullable();
            $table->boolean('participant_video')->nullable();
            $table->boolean('allow_participate_join_everytime')->nullable();
            $table->boolean('join_before_host')->nullable();
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
        Schema::dropIfExists('meetings');
    }
}
