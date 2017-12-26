<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from_user_id')->index()->comment('发送者的用户id');
            $table->unsignedInteger('to_user_id')->index()->comment('接受者的用户id');
            $table->text('body')->comment('私信内容');
            $table->timestamp('read_time')->nullable()->comment('阅读时间');
            $table->tinyInteger('is_read')->default(1)->comment('是否已阅读,0未读,1已读');
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
        Schema::dropIfExists('messages');
    }
}
