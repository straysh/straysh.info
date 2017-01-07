<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUser extends Migration
{
    protected $table = 'user_basic';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create($this->table, function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedBigInteger('uid');
            $table->string('displayname', 50)->nullable()->comment("昵称");
            $table->unsignedInteger('birthday')->nullable()->comment("出生日期");
            $table->unsignedTinyInteger('gender')->default(2)->comment("性别");
            $table->unsignedInteger('level')->default(0)->comment("用户等级");
            $table->unsignedInteger('credits')->default(0)->comment("积分");
            $table->text('introduction')->nullable()->comment("个人简介");

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
