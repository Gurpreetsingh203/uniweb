<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialLoginFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_social')->default(0)->comment('1 => Yes, 0 => No')->after('role');
            $table->enum('provider_type', ['google'])->nullable()->after('is_social');
            $table->string('provider_id')->nullable()->after('provider_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_social');
            $table->dropColumn('provider_type');
            $table->dropColumn('provider_id');
        });
    }
}
