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
			$table->string('type')->default('post'); // post, page
			$table->integer('user_id');
			$table->integer('category_id')->default(0);
			$table->string('author', 64)->nullable();
			$table->string('title');
			$table->string('slug');
			$table->unsignedInteger('hits')->default(0);
			$table->text('body');
//			$table->string('image')->nullable();
			$table->string('published_at')->nullable();
//			$table->string('title', 128);
//			$table->tinyInteger('nav_id', false, true)->default(0);

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
		Schema::dropIfExists($this->_table);
	}
}
