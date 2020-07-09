<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardTagRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_tag_relation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('board_id')->comment('投稿ID');
            $table->unsignedBigInteger('tag_id')->comment('タグID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_tag_relation');
    }
}
