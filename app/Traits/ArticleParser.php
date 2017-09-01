<?php namespace App\Traits;
use App\Models\Article;
use Illuminate\Mail\Markdown;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-9-1
 * Time: 下午2:24
 */
trait ArticleParser
{
    protected function explodeMeta($article)
    {
        $pattern = '#^({.*?})\n#si';
        preg_match($pattern, $article, $matches);
        unset($matches[0]);
        if(!isset($matches[1])) throw new \Exception("meta missing");

        return [json_decode($matches[1], TRUE), preg_replace($pattern, '', $article)];
    }

    protected function markdown(Article $article)
    {
//        list(, $content) = $this->explodeMeta($article->content);
        $content = (string)Markdown::parse($article->content);

        return "<h1 class='justcenter'>{$article->title}</h1><article>{$content}</article>";
    }
}