<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->nullable()->unique()->comment('标签名称');
            $table->string('images',128)->nullable()->comment('标签图标');
            $table->string('describe',1024)->nullable()->comment('描述');
            $table->integer('topics_count')->default(0)->nullable()->unsigned()->comment('关联话题总数');
            $table->integer('follows_count')->default(0)->nullable()->unsigned()->comment('关联话题总数');
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
        Schema::dropIfExists('tags');
    }
}
