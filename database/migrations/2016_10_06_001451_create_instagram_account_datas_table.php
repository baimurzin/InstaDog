<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstagramAccountDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_account_datas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('account_username')->index();
            $table->bigInteger('account_username_id')->default(0)->index();
            $table->jsonb('account_data')->nullable();

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
        Schema::drop('instagram_account_datas');
    }
}
