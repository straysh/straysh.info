<?php

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Option;

class OptionTableSeeder extends Seeder
{

    public function run()
    {
        Option::truncate();

        $options = array(
            array(
                'key' => 'site.name',
                'value' => 'Straysh\'s Blog'
            ),
            array(
                'key' => 'site.slogan',
                'value' => 'Straysh的博客管理后台'
            ),
            array(
                'key' => 'site.description',
                'value' => 'It\'s a website of Straysh\'s'
            ),
            array(
                'key' => 'site.keywords',
                'value' => 'pingpong, gravitano, blog, straysh'
            ),
            array(
                'key' => 'tracking',
                'value' => '<!-- GA Here -->'
            ),
            array(
                'key' => 'facebook.link',
                'value' => 'https://www.facebook.com/straysh'
            ),
            array(
                'key' => 'twitter.link',
                'value' => 'https://twitter.com/straysh'
            ),
            array(
                'key' => 'post.permalink',
                'value' => '{slug}'
            ),
            array(
                'key' => 'ckfinder.prefix',
                'value' => 'packages/pingpong/admin'
            ),
            array(
                'key' => 'admin.theme',
                'value' => 'default'
            ),
            array(
                'key' => 'pagination.perpage',
                'value' => 10
            ),
        );

        foreach ($options as $option) {
            Option::create($option);
        }
    }
}
