<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
	private $_table = 'article';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->down();
		Schema::create($this->_table, function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('category_id')->default(0);
			$table->string('author', 64)->nullable();
			$table->string('title');
			$table->string('slug');
			$table->unsignedInteger('hits')->default(0);
			$table->text('content');
			$table->string('head_image')->nullable();
			$table->string('published_at')->nullable();
			$table->char('md5sum', 32);

            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists($this->_table);
	}
}
