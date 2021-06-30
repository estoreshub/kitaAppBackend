<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_boards', function (Blueprint $table) {
            $table->id();
            $table->integer('kita_admin_id');
            $table->integer('parent_id');
            $table->string('title');
            $table->string('description');
            $table->json('images');
            $table->json('comments');
            $table->integer('status');
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
        Schema::dropIfExists('block_boards');
    }
}
