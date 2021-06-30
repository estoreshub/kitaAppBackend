<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('telephone');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('usercode');
            $table->string('username');
            $table->string('password');
            $table->integer('notification_access');
            $table->integer('email_allow');
            $table->integer('status');
            $table->integer('parent_type');
            $table->integer('kita_admin_id');
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
        Schema::dropIfExists('parents');
    }
}
