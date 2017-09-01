<?php namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Lifenote;
use Carbon\Carbon;
use DirectoryIterator;
use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-29
 * Time: 下午3:51
 */
class BlogMigratation  extends Command
{
    private $_category_migrated = false;
    private $_blog_migrated = false;
    private $_file = null;
    private $basePath=null;
    /**
     * @inherit
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:migrate
        {--all : migrate category list then blog articles.}
        {--dump : dump old blog to local files.}
        {--c|category : seed category list.}
        {--f|force : force seed blog.}
        {--b|blog : seed blog articles.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate local blog files to database';

    /**
     * Compatiblity for Laravel 5.5.
     *
     * @return void
     */
    public function handle()
    {
        $this->fire();
    }

    private function fire()
    {
        $this->basePath = env('BLOG_BASE_PATH', resource_path().'/assets/articles');
        $c = $this->option('category');
        $b = $this->option('blog');
        $d = $this->option('dump');

        if($d)
        {
            $this->dumpOldBlogs();
            $this->comment("all blog has been dumped to {$this->basePath}");
            return;
        }

        $this->_category_migrated = false;
        $this->_blog_migrated = false;
        if($c) $this->migrateCategory();
        if($b) $this->migrateBlog();
        if(empty($c) && empty($b))
        {
            $this->migrateCategory();
            $this->migrateBlog();
        }
    }

    private function migrateCategory()
    {
        if($this->_category_migrated) return;
        $category = file_get_contents($this->basePath.'/category.json');
        $category = json_decode($category, TRUE);
        DB::table('category')->insert($category);

        $this->comment('category sync complete!');
    }

    private function migrateBlog()
    {
        if($this->_blog_migrated) return;

        $basePath = $this->basePath;

        // 同步blog
        $this->getFile($basePath.'/blog', function($f)use($basePath){
            $this->_file = $f;
            $subFile = str_replace($basePath, '', $f);
            $article = file_get_contents($f);
            list($meta, $content) = $this->getMetainfo($subFile, $article);
            if($this->syncBlog($subFile, $meta, $content))
                $this->info($subFile);
        });

        // 同步lifenote
        $this->getFile($basePath.'/lifenote', function($f)use($basePath){
            $this->_file = $f;
            $subFile = str_replace($basePath, '', $f);
            $article = file_get_contents($f);
            list($meta, $content) = $this->getMetainfo($subFile, $article);
            if($this->syncLifenote($subFile, $meta, $content))
                $this->info($subFile);
        });

        $this->comment('blog sync complete!');
    }

    private function dumpOldBlogs()
    {
        $basePath = $this->basePath;
        //导出blog
        $lastid = 0;
        while(TRUE)
        {
            $models = DB::connection('raw')
                ->table('article')
                ->whereRaw("id > {$lastid}")
                ->limit(10)
                ->orderByRaw('id ASC')
                ->get();
            if($models->isEmpty()) break;

            foreach ($models as $item)
            {
                $lastid = $item->id;
                $meta = [
                    'id'          => $item->id,
                    'user_id'     => $item->user_id,
                    'category_id' => $item->category_id,
                    'author'      => $item->author,
                    'title'       => $item->title,
                    'slug'        => $item->slug,
                    'hits'        => $item->hits,
                    'published_at'=> $item->published_at,
                    'created_at'  => $item->created_at,
                    'updated_at'  => $item->updated_at,
                    'deleted_at'  => $item->deleted_at,
                ];
                $content = $item->content;
                $meta = json_encode($meta, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
                $content = $meta."\n".$content;

                $path = $this->prepareDirectory($basePath.'/blog', $item->created_at);
                $slug = str_replace('/', '|', $item->slug);
                $path = "{$path}/{$slug}.md";
                file_put_contents($path, $content);
                $this->info("[OK]".str_replace($basePath, '', $path));
            }
        }

        //导出lifenote
        $lastid = 0;
        while(TRUE)
        {
            $models = DB::connection('raw')
                ->table('life')
                ->whereRaw("id > {$lastid}")
                ->limit(10)
                ->orderByRaw('id ASC')
                ->get();
            if($models->isEmpty()) break;

            foreach ($models as $item)
            {
                $lastid = $item->id;
                $meta = [
                    'id'          => $item->id,
                    'title'       => $item->title,
                    'slug'        => $item->slug,
                    'created_at'  => $item->created_at,
                    'updated_at'  => $item->updated_at,
                    'deleted_at'  => $item->deleted_at,
                ];
                $content = $item->content;
                $meta = json_encode($meta, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
                $content = $meta."\n".$content;

                $path = $this->prepareDirectory($basePath.'/lifenote', $item->created_at);
                $slug = str_replace('/', '|', $item->slug);
                $path = "{$path}/{$slug}.md";
                file_put_contents($path, $content);
                $this->info("[OK]".str_replace($basePath, '', $path));
            }
        }
    }

    private function prepareDirectory($path, $timestamp)
    {
        $carbon = Carbon::createFromTimestamp($timestamp);
        $year = $carbon->year;
        $month = $carbon->month;

        $path = "{$path}/{$year}";
        if(!file_exists($path)) mkdir($path);
        $path = "{$path}/{$month}";
        if(!file_exists($path)) mkdir($path);
        return $path;
    }

    private function getFile($directory, \Closure $callback)
    {
        /* @var RecursiveDirectoryIterator $it */
        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS));

        $it->rewind();
        while($it->valid())
        {
            $callback($it->getRealPath());
            $it->next();
        }
    }

    private function getMetainfo($file, $article)
    {
        $pattern = '#^({.*?})\n#si';
        preg_match($pattern, $article, $matches);
        unset($matches[0]);
        if(!isset($matches[1])) throw new \Exception("{$file}, empty meta info");

        return [json_decode($matches[1], TRUE), preg_replace($pattern, '', $article)];
    }

    private function syncBlog($file, $meta, $content)
    {
        if(!empty($meta['id']))
        {
            if(!is_int($meta['id']))
            {
                $this->error('article id is not int');
                dd($meta);
            }
            $model = Article::withTrashed()->find($meta['id']);
        }
        if(empty($model))
            $model = new Article();

        $md5sum = $this->sign($meta, $content);
        if(!$this->option('force') && $model->md5sum && $model->md5sum===$md5sum)
        {
            $this->comment("skip because nothing modified...{$file}");
            return FALSE;
        }

        if(is_int($meta['id'])) $model->id           = $meta['id'];
        $model->user_id      = $meta['user_id'];
        $model->category_id  = $meta['category_id'];
        $model->author       = $meta['author'];
        $model->title        = $meta['title'];
        $model->slug         = $meta['slug'];
        $model->hits         = $meta['hits'];
        $model->content      = $content;
        $model->published_at = $this->toDate($meta['published_at']);
        $model->created_at   = $this->toDate($meta['created_at']);
        $model->updated_at   = $model->created_at;
        $model->deleted_at   = $this->toDate($meta['deleted_at']);
        $model->md5sum       = $md5sum;

        if(!$model->save())
        {
            $this->error("save article fail");
            dd($meta, $model->toArray());
        }
        return TRUE;
    }

    private function syncLifenote($file, $meta, $content)
    {
        if(!empty($meta['id']))
        {
            if(!is_int($meta['id']))
            {
                $this->error('lifenote id is not int');
                dd($meta);
            }
            $model = Lifenote::withTrashed()->find($meta['id']);
        }
        if(empty($model))
            $model = new Lifenote();

        $md5sum = $this->sign($meta, $content);
        if($model->md5sum && $model->md5sum===$md5sum)
        {
            $this->comment("skip because nothing modified...{$file}");
            return FALSE;
        }

        if(is_int($meta['id'])) $model->id           = $meta['id'];
        $model->title        = $meta['title'];
        $model->slug         = $meta['slug'];
        $model->content      = $content;
        $model->created_at   = $this->toDate($meta['created_at']);
        $model->updated_at   = $this->toDate($meta['updated_at']);
        $model->deleted_at   = $this->toDate($meta['deleted_at']);
        $model->md5sum       = $md5sum;

        if(!$model->save())
        {
            $this->error("save article fail");
            dd($meta, $model->toArray());
        }
        return TRUE;
    }

    private function sign($meta, $content)
    {
        $meta = json_encode($meta, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        $content = "{$meta}\n{$content}";
        return md5($content);
    }

    private function toDate($time)
    {
        if(empty($time)) return null;
        return Carbon::createFromTimestamp($time)->toDateTimeString();
    }
}