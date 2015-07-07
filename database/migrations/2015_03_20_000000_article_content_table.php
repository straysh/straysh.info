<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticleContentTable extends Migration
{

	private $_table = 'article_content';

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
			$table->tinyInteger('article_id', false, true);
			$table->text('content');

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
