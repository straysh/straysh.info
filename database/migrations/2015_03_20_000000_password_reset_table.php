<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PasswordResetTable extends Migration
{
	private $_table = 'password_reset';

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
			$table->string('email')->index();
			$table->string('token')->index();

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
