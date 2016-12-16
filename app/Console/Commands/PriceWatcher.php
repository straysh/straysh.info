<?php namespace App\Console\Commands;

use App\Exceptions\DevAuthorizeException;
use App\Exceptions\DevBaseException;
use App\Http\Helpers\Crawler\Http;
use App\Http\Helpers\Crawler\SimpleCrawler;
use App\Http\Helpers\ErrorCode;
use App\Http\Helpers\Yconst;
use App\Http\Helpers\Yutils;
use App\Http\Models\Frontend\PriceCart;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputArgument;

/**
 * @property Http $http
 */
class PriceWatcher extends Command
{
    use DispatchesJobs;

    private $http;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'price:watch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'functional utilities';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->http = Http::getInstance();
        $lastid = 0;
        while(TRUE)
        {
            $query = DB::table("price_cart")
                ->whereRaw("id>?", [$lastid])
                ->orderByRaw("id ASC")
                ->limit(100);
            $result = $query->get();
            if(empty($result))
                break;
            /* @var PriceCart $item */
            foreach($result as $item)
            {
                $lastid = $item->id;
                $url = $item->watch_url;
                $page = $this->loadPage($url);
                $data = $this->parsePrice($page);
                $this->saveToDb($lastid, $data);
            }
        }
        $this->log("loop done!");
    }

    protected function unknown()
    {
        $this->error("no method specified!");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['action', InputArgument::OPTIONAL, 'internal action', null],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }

    /*************************************************
     *    COMMAND DETAILS
     ***********************************************/

    /**
     * @param $url
     * @return string
     */
    private function loadPage($url)
    {
        $name = md5($url);
        $path = storage_path()."/price_watcher/{$name}";
        if(!file_exists($path))
            mkdir($path, 0775, TRUE);

        $name = date("Y-m-d")."_.html";
        $_path = "{$path}/{$name}";
        if(!file_exists($_path))
        {
            $content = file_get_contents($url);
            file_put_contents($_path, $content);
        }else
        {
            $content = file_get_contents($_path);
        }

        preg_match('#<iframe\s+src="(.*?)".*?id="iframeId"#si', $content, $matches);
        unset($matches[0]);
        $real_url = "http://tool.manmanbuy.com/{$matches[1]}";

        $name = date("Y-m-d").".html";
        $_path = "{$path}/{$name}";
        if(!file_exists($_path))
        {
            $this->log($real_url);
            /* @var Http */
            $content = $this->http->request($real_url, $this->headers);
            file_put_contents($_path, $content);
        }else
        {
            $content = file_get_contents($_path);
        }

        return $content;
    }

    protected function log($str)
    {
        $this->line(date('[Y-m-d H:i:s]', time())."".$str);
    }

    private $headers = [
        "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
        "Accept-Language:zh-CN,zh;q=0.8,en;q=0.6,zh-TW;q=0.4,pt;q=0.2,es;q=0.2,sk;q=0.2,ny;q=0.2",
        "Cache-Control:max-age=0",
        "Connection:keep-alive",
        "Cookie:ASP.NET_SessionId=k1kwsvzsnpfm1eg3t255ews3; tanchuang1=1; spurl=http://item.jd.com/2529194.html; amvid=5b408bd2e92b6aad20ae36c409703c86; Hm_lvt_85f48cee3e51cd48eaba80781b243db3=1478072368,1478225643; Hm_lpvt_85f48cee3e51cd48eaba80781b243db3=1478227564; Hm_lvt_01a310dc95b71311522403c3237671ae=1478072368,1478225643; Hm_lpvt_01a310dc95b71311522403c3237671ae=1478227564",
        "Host:tool.manmanbuy.com",
        "Upgrade-Insecure-Requests:1",
        "User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
    ];

    private function parsePrice($html)
    {
        preg_match('#chart\("(.*?)"\)#si', $html, $matches);
        unset($matches[0]);
        $matches[1] = str_replace(',', '-', $matches[1]);
        $json = "[".str_replace(["Date.UTC(", ")-", "]-"], ['"', '",', "],"], $matches[1])."]";
        $json = json_decode($json, TRUE);

        return $json;
    }

    private function saveToDb($item_id, $data)
    {
        $query = "INSERT IGNORE INTO `price_watcher` (item_id, price, price_date, created_at, updated_at) ";
        $values = [];
        $time = time();
        foreach($data as $item)
        {
            $values[] = "({$item_id}, {$item[1]}, '{$item[0]}', {$time}, {$time})";
        }
        $values = implode(',', $values);

        $query = "{$query} VALUES {$values}";

        DB::statement($query);
    }
}