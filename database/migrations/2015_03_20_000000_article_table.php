<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticleTable extends Migration
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
			$table->string('title', 128);
			$table->string('author', 64)->nullable();
			$table->tinyInteger('nav_id', false, true)->default(0);
			$table->unsignedInteger('hits')->default(0);

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
		Schema::dropIfExists($this->_table);
	}

}
