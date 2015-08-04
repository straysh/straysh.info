<?php namespace App\Console\Commands;

use App\Models\Frontend\Article;
use App\ModelServices\CategoryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Blog extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'blog:auto_save';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'auto saveing blog';

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
		$action = $this->argument('action');
		switch($action)
		{
			default:
				$this->autoSave();
				break;
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['action', null, InputArgument::REQUIRED, 'internal action'],
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
            ['file', 'f', InputOption::VALUE_REQUIRED, 'file path', 'file path']
        ];
	}

	/*************************************************
	 *    COMMAND DETAILS
	 ***********************************************/

	protected function autoSave()
	{

        $file = $this->option('file');
        if(!file_exists($file)) exit(-1);

        $time = time();
        $names = pathinfo($file, PATHINFO_FILENAME);
        $names = explode('.', $names);
        $title = $names[0];
        $slug = $names[1];
        $content = file_get_contents($file);

        $model = Article::whereRaw("slug=?", [$slug])->first();
        if($model)
        {
            $model->body = $content;
        }else
        {
            $model = new Article();
            $category_id = $this->parseCategory($file);
            $model->title = $title;
            $model->slug = $slug;
            $model->body = $content;
            $model->category_id = $category_id;
            $model->user_id = 1;
            $model->author = 'straysh';
            $model->published_at = $time;
        }

        if(!$model->save())
        {
            var_dump($model->toArray());
            exit(-1);
        }

		$this->info("work done!");
	}

    private function parseCategory($path)
    {
        $path = pathinfo($path, PATHINFO_DIRNAME);
        $path = pathinfo($path, PATHINFO_FILENAME);
        return CategoryService::getInstance()->getId($path);
    }

}
