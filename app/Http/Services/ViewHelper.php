<?php namespace App\Http\Services;

use App\Http\Helpers\utils\Parsedown;
use App\Http\Helpers\Yutils;
use App\Http\Models\Frontend\Category;

class ViewHelper
{
	public function registerRequireScript($templateId)
	{
		return Yutils::getInstance()->registerRequireScript($templateId);
	}

	public function registerJsTemplate($templateArray)
	{
		if(is_string($templateArray))
		{
			$templateArray = (array)$templateArray;
		}
		$templateArray = array_unique($templateArray);
		$tplTag = "<script id='%s-tpl' type='text/template'>%s</script>";
		$errorTag = "<script>%s</script>";
		$tpl = '';
		$path = base_path().'/resources/views/frontend/JsTemplate';
		$emptyTemplate = $path."/empty.blade.php";
		foreach($templateArray as $id)
		{
			$file = $path.'/'.str_replace('.', '/', $id).'.blade.php';
			if(file_exists($file))
			{
				$view = view()->file($file, ["__id"=>$id])->render();
				$view = sprintf($tplTag, str_replace('.', '-', $id), $view);
				$tpl .= str_replace(['-feed-', '-timeline-'], '-timeline-feed-', $view);
			}else{
				$file = $emptyTemplate;
				$view = view()->file($file, ["__id"=>$id])->render();
				$tpl .= sprintf($errorTag, $view);
			}
		}
		return $tpl;
	}

	public function apiHost()
	{
		return 'http://'.config('setting.api_host');
	}

	public function webHost()
	{
		return 'http://'.config('setting.web_host');
	}

	public function chatHost()
	{
		return 'http://'.config('setting.chat_host');
	}

	public function json_encode($array)
	{
		$json = json_encode($array);
		return $json ?: 'null';
	}

	public function renderSideTree()
	{
		$str[] = '<ul>';
		$data = Category::getInstance()->getNavList();
		$tpl = '<li><a href="%s" title="%s">%s (%s)</a></li>';
		foreach($data as $item)
		{
			$str[] = sprintf($tpl,
				'/article/'.strtolower($item->name),
				$item->name,
				$item->name,
				$item->article_amount );
		}
		$str[] = '</ul>';
		echo implode('', $str);
	}

	public function markdownParse($str, $closeTags=['', ''])
	{
		$parseDown = new Parsedown();
		$str = $parseDown->text($str);
		return "{$closeTags[0]}{$str}{$closeTags[1]}";
	}

}