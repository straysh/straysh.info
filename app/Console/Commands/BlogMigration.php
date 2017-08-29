<?php namespace App\Console\Commands;

use App\Http\Models\Www\Category;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-29
 * Time: 下午3:51
 */
class BlogMigratation  extends Command
{
    private $_category_migrated = false;
    private $_blog_migrated = false;
    /**
     * @inherit
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:migrate
        {--all : migrate category list then blog articles.}
        {--dump : dump old blog to local files.}
        {--c|category : migrate category list.}
        {--b|blog : migrate blog articles.}';

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
        $c = $this->option('category');
        $b = $this->option('blog');
        $d = $this->option('dump');

        if($d)
        {
            $this->dumpOldBlogs();
            $this->comment('all blog has been dumped to '.resource_path().'/assets/articles');
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
        $category = file_get_contents(resource_path().'/assets/category.json');
        $category = json_decode($category, TRUE);
        DB::table('category')->insert($category);

        $this->comment('category');
    }

    private function migrateBlog()
    {
        if($this->_blog_migrated) return;

        $this->comment('blog');
    }

    private function dumpOldBlogs()
    {
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
            if(empty($models)) break;

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
                $content = $item->body;
                $meta = json_encode($meta, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
                $content = $meta."\n".$content;
                file_put_contents(resource_path().'/assets/articles/1.md', $content);
                dd("done!");
            }
        }

        //导出lifenote
    }
}