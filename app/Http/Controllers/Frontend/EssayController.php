<?php namespace App\Http\Controllers\Frontend;

use App\Exceptions\DevInvalidParamsException;
use App\Http\Models\Frontend\Life;
use App\Http\Models\Frontend\PriceCart;
use App\Http\Models\Frontend\PriceWatcher;
use App\Http\ModelServices\ArticleService;
use Illuminate\Http\Request;

class EssayController extends FrontController
{

	public function getIndex(Request $request)
	{
        return $this->redirectBack();
        $options = $this->pageParams($request->all());
        $articles = [];//ArticleService::getInstance()->timeline($options);
        $this->viewData('maxPage', 0);
        $this->viewData('page', 1);
//        unset($articles['maxPage']);
        $this->viewData('articles', $articles);

        $this->viewData('navMenuActive', 'essay');
        return view("frontend.article.article_timeline", $this->viewData);
	}

    //http://tool.manmanbuy.com/historyLowest.aspx?url=http%3a%2f%2fitem.jd.com%2f10358413225.html
    public function getPriceWatcher(Request $request)
    {
        $item_id = $request->input("item_id");
        if(empty($item_id))
        {
            $items = PriceCart::orderByRaw("id ASC")->get();
            $this->viewData("items", $items);
        }else
        {
            $query = PriceWatcher::whereRaw("item_id=?", [$item_id])
                ->orderByRaw("price_date ASC");
            $models = $query->get();
            $data = [];
            foreach($models as $item)
            {
                $data[] = sprintf("[Date.UTC(%s),%.2f]", date("Y,n,j", strtotime($item->price_date)), $item->price);
            }
            $this->viewData("data", implode(',', $data));
            $this->viewData("item", PriceCart::where('id', $item_id)->first());
        }


        $this->viewData('bodyId', 'article-container');
        return view("frontend.price_watcher.carts", $this->viewData);
    }

    public function postPriceWatcher(Request $request)
    {
        $name = $request->input("name");
        $raw_url = $request->input("raw_url");
        $watch_url = $request->input("watch_url");
        $desc = $request->input("desc");

        if(empty($name) || empty($raw_url) || empty($watch_url))
            throw new DevInvalidParamsException();

        $model = new PriceCart();
        $model->name = $name;
        $model->raw_url = $raw_url;
        $model->watch_url = $watch_url;
        $model->desc = $desc;
        $model->save();

        return redirect("/essay/price-watcher");
    }
}
