<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('昵称');
            $table->string('email')->unique()->comment('邮箱');
            $table->integer('github_id')->index()->comment('githubId');
            $table->string('github_url')->comment('githubUrl');
            $table->string('password')->comment('密码');
            $table->string('city')->nullable()->comment('城市');
            $table->string('company')->nullable()->comment('公司');
            $table->string('introduction')->nullable()->comment('自我介绍');
            $table->integer('notification_count')->default(0)->comment('通知总数');
            $table->string('github_name')->index()->comment('github名称');
            $table->string('real_name')->nullable()->comment('真实名称');
            $table->string('avatar')->comment('头像');
            $table->boolean('verified')->default(false)->index();
            $table->string('register_source')->index()->comment('注册方式');
            $table->string('is_banned',5)->default(false)->index()->comment('是否禁止用户');
            $table->string('email_notify_enabled',5)->default(false)->index()->comment('邮箱是否激活');
            $table->timestamp('last_actived_at')->nullable()->comment('最后活跃时间');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
