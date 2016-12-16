<?php

use App\Http\Models\Frontend\Category;

class CategoryTableSeeder extends BaseTableSeeder
{
	public function run()
   	{
		$this->truncate('category');

	    $data = $this->data();
	    $time = time();
	    array_walk($data, function(&$v) use($time){
		    $v['created_at'] = $time;
		    $v['updated_at'] = $time;
	    });
	    Category::insert($data);

   	}

	private function data()
	{
		return [
			[
				'id' => 1,
				'pid' => 0,
				'nav_name' => 'PHP',
				'nav_zh' => null,
				'article_amount' => 0,
				'order' => 102
			],
			[
				'id' => 2,
				'pid' => 0,
				'nav_name' => 'MySQL',
				'nav_zh' => null,
				'article_amount' => 0,
				'order' => 103
			],
			[
				'id' => 3,
				'pid' => 0,
				'nav_name' => 'Yii',
				'nav_zh' => null,
				'article_amount' => 2,
				'order' => 100
			],
			[
				'id' => 4,
				'pid' => 0,
				'nav_name' => 'Translation',
				'nav_zh' => '试译',
				'article_amount' => 0,
				'order' => 201
			],
			[
				'id' => 5,
				'pid' => 0,
				'nav_name' => 'favorite',
				'nav_zh' => '博文收藏',
				'article_amount' => 0,
				'order' => 255
			],
			[
				'id' => 6,
				'pid' => 0,
				'nav_name' => 'Nginx',
				'nav_zh' => 'Nginx',
				'article_amount' => 0,
				'order' => 104
			]
		];
	}

}