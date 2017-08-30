<?php namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Lifenote;
use App\Traits\JsonResponseData;
use Illuminate\Mail\Markdown;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-8
 * Time: 下午2:06
 */
class LifenoteController extends Controller
{
    use JsonResponseData;

    public function __construct()
    {

    }

    public function index()
    {
        $articles = Lifenote::orderByRaw('id DESC')->get();

        $data = [];
        foreach ($articles as $item)
        {
            $data[] = $this->formatLifenote($item->toArray());
        }

        return $this->success($data);
    }

    private function formatLifenote($item)
    {
        $data = [];
        $pattern = '#原文:(.*)\n#i';
        preg_match($pattern, $item['content'], $matches);
        unset($matches[0]);
        if(isset($matches[1]))
        {
            $data['link'] = $matches[1];
            $item['content'] = preg_replace($pattern, '', $item['content']);
        }else
        {
            $data['link'] = '';
        }
        $data['content'] = (string)Markdown::parse($item['content']);
        $data['title'] = $item['title'];

        return $data;
    }
}