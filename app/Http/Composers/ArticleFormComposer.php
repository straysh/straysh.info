<?php namespace App\Http\Composers;

use App\Models\Frontend\Category;

class ArticleFormComposer
{

    public function compose($view)
    {
        $categories = Category::lists('name', 'id');

        $view->with(compact('categories'));
    }
}
