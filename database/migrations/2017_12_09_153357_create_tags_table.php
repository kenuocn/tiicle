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
            $table->string('name')->index()->comment('标签名称');
            $table->text('bio')->nullable()->comment('标签描述');
            $table->string('images')->nullable()->comment('标签图标');
            $table->integer('articles_count')->default(0)->comment('文章总数');
            $table->integer('follows_count')->default(0)->comment('关注总数');
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
