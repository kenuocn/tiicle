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
            $table->integer('github_id')->index()->nullable()->comment('githubId');
            $table->string('github_name')->index()->nullable()->comment('github名称');
            $table->string('github_url')->nullable()->comment('githubUrl');
            $table->string('password')->comment('密码');
            $table->string('city')->nullable()->comment('城市');
            $table->string('company')->nullable()->comment('公司');
            $table->string('introduction')->nullable()->comment('自我介绍');
            $table->integer('notification_count')->default(0)->comment('通知总数');
            $table->string('real_name')->index()->nullable()->comment('真实名称');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('register_source')->nullable()->index()->comment('注册方式');
            $table->tinyInteger('is_banned')->default(0)->index()->comment('是否禁止用户');
            $table->tinyInteger('email_notify_enabled')->default(0)->index()->comment('邮箱是否激活');
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
