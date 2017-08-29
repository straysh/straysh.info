<?php namespace App\Models;
use Illuminate\Mail\Markdown;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-28
 * Time: 下午4:07
 */
class Blog
{
    private $_article;
    private $_meta_pattern = '#^({.*?})\n#si';
    public $title;
    public $slug;
    public $author;
    public $content;
    public $link;
    public $thumbnailImage;

    public function __construct(string $article)
    {
        $this->_article = $article;
    }

    public function build()
    {
        $this->buildMeta();
        $this->buildContent();
        return $this;
    }

    private function buildMeta()
    {
        preg_match($this->_meta_pattern, $this->_article, $matches);
        unset($matches[0]);
        if(!isset($matches[1])) return;

        $meta = json_decode($matches[1], TRUE);
        $this->title  = $meta['Title']??'';
        $this->slug   = $meta['Slug']??'';
        $this->author = $meta['Author']??'';
    }

    private function buildContent()
    {
        $pattern = '#原文:(.*)\n#i';
        $article = preg_replace($this->_meta_pattern, '', $this->_article);
        preg_match($pattern, $article, $matches);
        unset($matches[0]);
        if(isset($matches[1]))
        {
            $this->link = $matches[1];
            $article = preg_replace($pattern, '', $article);
            $this->content = (string)Markdown::parse($article);
        }else
        {
            $this->link = '';
            $this->content = (string)Markdown::parse($article);
        }
    }

    public function toArray()
    {
        return [
            'title' => $this->title?:'',
            'slug'  => $this->slug?:'',
            'author'=> $this->author?:'',
            'content'=> $this->content?:'',
            'link'  => $this->link?:'',
            'thumbnail-image' => '',
            'category_id' => 1,
        ];
    }
}