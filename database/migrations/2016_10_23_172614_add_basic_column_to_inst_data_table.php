<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBasicColumnToInstDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instagram_account_datas', function (Blueprint $table) {
            $table->integer('followings_count')->default(0);
            $table->integer('followers_count')->default(0);
            $table->integer('media_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instagram_account_datas', function (Blueprint $table) {
            $table->dropColumn(['media_count', 'followers_count', 'followings_count']);
        });
    }
}
