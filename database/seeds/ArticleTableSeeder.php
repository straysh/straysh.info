<?php

use App\Models\Frontend\Article;

class ArticleTableSeeder extends BaseTableSeeder
{
	public function run()
   	{
		$this->truncate('article');

	    $data = $this->data();
	    Article::insert($data);

   	}

	private function data()
	{
		return [
			[
				'id' => 1,
				'title' => '博文测试',
				'author' => 'straysh',
				'nav_id' => 3,
				'created_at' => mktime(1, 34, 45, 10, 23, 2013),
				'updated_at' => mktime(1, 34, 45, 10, 23, 2013),
			],
			[
				'id' => 2,
				'nav_name' => 'demo blog入口分析',
				'author' => 'straysh',
				'nav_id' => 3,
				'created_at' => mktime(1, 34, 45, 9, 23, 2013),
				'updated_at' => mktime(1, 34, 45, 9, 23, 2013),
			]
		];
	}

}