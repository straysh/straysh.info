<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLoginUser extends Migration
{
	protected $table = 'login_user';

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
            $table->string('unionid', 32)->nullable()->unique()->comment("微信唯一标识");
            $table->string('email', 128)->nullable()->unique();
            $table->string('mobile', 32)->nullable()->unique()->comment("带国际码的手机号");
            $table->char('password', 64);
            $table->string('remember_token', 100)->nullable();
            $table->unsignedBigInteger('avatar')->default(0);
            $table->unsignedBigInteger('src_id')->default(0);
            $table->tinyInteger('is_active')->default(0)->comment('账号是否激活');
            $table->tinyInteger('state')->default(1)->comment('账号状态');

			$table->unsignedInteger('created_at')->default(0);
			$table->unsignedInteger('updated_at')->nullable();
			$table->unsignedInteger('deleted_at')->nullable();
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
