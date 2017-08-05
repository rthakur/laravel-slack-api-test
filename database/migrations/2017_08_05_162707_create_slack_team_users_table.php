<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlackTeamUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slack_team_users', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('slack_team_id');
            $table->string('slack_id');
            $table->string('name');
            $table->string('real_name');
            $table->string('tz')->nullable();
            $table->string('tz_label')->nullable();
            $table->string('tz_offset')->nullable();
            $table->text('profile_image')->nullable();
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
        Schema::dropIfExists('slack_team_users');
    }
}
