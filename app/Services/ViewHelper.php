<?php namespace App\Services;

use App\Helpers\utils\Parsedown;
use App\Helpers\Yutils;
use App\Models\Frontend\Category;
use Illuminate\Support\Facades\Request;

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
		$path = base_path().'/resources/views/JsTemplate';
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
				'/article/'.strtolower($item->nav_name),
				$item->nav_name,
				$item->nav_name,
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

//	public function articleMarkdownParser($category)
//	{
//		$categoryUrl = "/article/{$category->nav_name}";
//		$homeurl = $this->webHost();
//		$crumbs = <<<HTML
//__Straysh的个人博客__ » [首页][1] » [{$category->nav_name}][2]
//
//[1]:{$homeurl} "Straysh的个人博客"
//[2]:{$categoryUrl} "{$category->nav_name}"
//
//<form action="/search" class="header-search pull-left hidden-sm hidden-xs" onclick="alert('not implemented yet!');return false;">
//    <button type="submit" class="btn btn-link"><span class="sr-only">搜索</span><span class="glyphicon glyphicon-search"></span></button>
//    <input id="searchBox" name="q" type="text" placeholder="输入关键字搜索" class="form-control" value="" style="width: 180px;">
//</form>
//HTML;
//
//		$parseDown = new Parsedown();
//		$crumbs = $parseDown->text($crumbs);
//		return "<crumbs><h4>{$crumbs}</h4></crumbs>";
//	}



//	public function articleList($articles)
//	{
//		$data = [];
//		foreach($articles as $Aarticle)
//		{
//			$date = date('Y-m', $Aarticle->created_at);
//			$data[$date][] = $Aarticle;
//			$date = NULL;
//		}
//		$Aarticle = NULL;
//
//		$str = [];
//		foreach($data as $date => $items)
//		{
//			$str[] = "#{$date}\n\n";
//			$items = array_reverse($items);
//			foreach($items as $i => $Aarticle)
//			{
//				++$i;
//				$url = "/article/{$Aarticle['id']}";
//				$str[] = "{$i}. [{$Aarticle->title}]({$url})\n";
//			}
//			$str[] = "***\n\n";
//		}
//
//		$str = implode('', $str);
//		$parseDown = new Parsedown();
//		$content = $parseDown->text($str);
//		return "<content>{$content}</content>";
//	}

}