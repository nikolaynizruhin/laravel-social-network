<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->integer('follower_id')->unsigned();
            $table->integer('followee_id')->unsigned();
            $table->timestamps();

            $table->primary(['follower_id', 'followee_id']);
            $table->unique(['follower_id', 'followee_id']);

            $table->foreign('follower_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('followee_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('follows', function (Blueprint $table) {
            $table->dropForeign('follows_follower_id_foreign');
            $table->dropForeign('follows_followee_id_foreign');
        });

        Schema::dropIfExists('follows');
    }
}
