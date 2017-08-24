<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    protected $table = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create($this->table, function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('username', 64)->nullable();
            $table->unsignedTinyInteger('reg_type')->default(0)->comment("0:未知,1:手机,2:邮箱,3:微信");
            $table->unsignedTinyInteger('client_type')->default(0)->comment("0:未知");
            $table->string('unionid', 32)->nullable()->unique()->comment("微信唯一标识");
            $table->string('email', 128)->nullable()->unique();
            $table->string('mobile', 32)->nullable()->unique()->comment("带国际码的手机号");
            $table->char('password', 64);
            $table->string('remember_token', 100)->nullable();
            $table->unsignedBigInteger('avatar')->default(0)->comment('头像id');
            $table->unsignedBigInteger('src_id')->default(0)->comment('头像原图片id');
            $table->tinyInteger('is_active')->default(0)->comment('账号是否激活:0未激活/1已激活');
            $table->tinyInteger('state')->default(1)->comment('账号状态:0禁用/1启用');

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
        Schema::dropIfExists($this->table);
    }

}
