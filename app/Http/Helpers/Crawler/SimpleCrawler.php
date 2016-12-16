<?php namespace App\Http\Helpers\Crawler;

class SimpleCrawler
{
    private $command = null;
    private $log = null;
    private $maxTryTimes = 10;
    private $tryTime = 0;

    public function __construct($command, $max=null)
    {
        $this->command = $command;
        if(is_numeric($max)) $this->maxTryTimes = $max;
        $this->log = storage_path()."/logs/file_get_contents.log";
    }

    public function resetCounter()
    {
        $this->tryTime = 0;
    }

    public function file_get_content($url)
    {
        $ctx = stream_context_create([
            'http'=>[
                'timeout' => 60, // 1 200 Seconds = 20 Minutes
            ]
        ]);

        $html = @file_get_contents($url, false, $ctx);
        if($html === false)
        {
            ++$this->tryTime;
            if($this->command) $this->command->line("{$url} trying #{$this->tryTime}/{$this->maxTryTimes}# times.");
            if($this->tryTime >= $this->maxTryTimes)
            {
                if($this->command)
                {
                    $this->command->error("skipped");
                    file_put_contents($this->log, $url.PHP_EOL, FILE_APPEND);
                }

                return false;
            }
            return $this->file_get_content($url);
        }
        return $html;
    }

    public function curlGet($url, $timeout=5)
    {
        $curl = Http::getInstance();
        $html = $curl->request($url, null, ['timeout'=>$timeout]);
        if(($error = $curl->getError()))
        {
            ++$this->tryTime;
            if($this->command) $this->command->line("{$url} trying #{$this->tryTime}/{$this->maxTryTimes}# times.");
            if($this->tryTime > $this->maxTryTimes)
            {
                if($this->command)
                {
                    $this->command->error("[error]{$error}skipped");
                    file_put_contents($this->log, $url.PHP_EOL, FILE_APPEND);
                }

                return false;
            }
            return $this->curlGet($url);
        }
        return $html;
    }
}