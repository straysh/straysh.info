<?php

class BaseTableSeeder extends \Illuminate\Database\Seeder
{
	protected function truncate($tableName)
	{
		if(empty($tableName))
		{
			$this->command->error(get_class($this)."->truncate(\$tableName); \$tableName not specified!");exit;
		}
		$this->command->info("Truncated: {$tableName}");
		DB::table($tableName)->truncate();
	}
}