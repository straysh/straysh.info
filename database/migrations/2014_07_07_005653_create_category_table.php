<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryTable extends Migration
{

	private $_table = 'category';

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
			$table->unsignedInteger('pid')->default(0);
			$table->string('name', 64);
			$table->string('name_zh', 64)->nullable();
			$table->string('slug')->unique();
			$table->unsignedInteger('article_amount')->default(0);
			$table->unsignedInteger('order')->default(0);
			$table->text('description')->nullable();

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
