<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToSchoolSubGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_sub_groups', function (Blueprint $table) {
            $table->string('timeframe')->nullable()->comment('1 week, 2 weeks, 3 weeks, a month, indefinite')->after('name');
            $table->dateTime('expire_at')->nullable()->after('timeframe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_sub_groups', function (Blueprint $table) {
            $table->dropColumn('timeframe');
            $table->dropColumn('expire_at');
        });
    }
}
