<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->nullable()->unsigned()->comment('话题id');
            $table->integer('tag_id')->nullable()->unsigned()->comment('标签id');
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
        Schema::dropIfExists('topic_tag');
    }
}
