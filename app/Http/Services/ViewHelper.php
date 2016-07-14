<?php namespace App\Http\Services;

use App\Http\Helpers\utils\Parsedown;
use App\Http\Helpers\Yutils;
use App\Http\Models\Frontend\Category;
use Illuminate\Support\Facades\App;

class ViewHelper
{
	public function registerLang()
	{
		$lang = App::getLocale();
		$langPath = base_path()."/resources/lang/{$lang}";

		$results = [];
		foreach (new \DirectoryIterator($langPath) as $fileInfo) {
			if($fileInfo->isDot()) continue;
			if(mb_substr($fileInfo, 0, 1) === '.') continue;
			$results[pathinfo($fileInfo, PATHINFO_FILENAME)] = include("{$langPath}/{$fileInfo}");
		}

		$lang = "<script>var Ylang = eval(".json_encode($results).");</script>";
		return $lang;
	}

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
				$tpl .= str_replace(['-feed-', '-timeline-'], '-timelineFeed-', $view);
			}else{
				$file = $emptyTemplate;
				$view = view()->file($file, ["__id"=>$id])->render();
				$tpl .= sprintf($errorTag, $view);
			}
		}
		return $this->trimJsTpl($tpl);
	}

	public function registerRequirejs($name)
	{
		$name = explode('/', $name);
		$filename = $name[1];
		$version = config('app.debug') ? time() : config('setting.app_version');
		if( config('app.debug') )
		{
			$js[] = "<script src='/js_develop/app/mainConfigFile.js'></script>";
			$js[] = "<script data-main='/js_develop/app/%s.js?r={$version}' src='/js_develop/require.js'></script>";
		}else
		{
			$js[] = "<script src='/js/%s.min.js?r={$version}'></script>";
		}

		$js = implode('', $js);

		return sprintf($js, $filename);
	}

	public function registerCssScript($filename)
	{
		$version = config('app.debug') ? time() : config('setting.app_version');
		if(config('app.debug'))
		{
			$href = asset("/css_develop/{$filename}.css?r={$version}");
		}else
		{
			$href = asset("/css/{$filename}.min.css?r={$version}");
		}
		return "<link rel=\"stylesheet\" href=\"{$href}\" />";
	}

	/**
	 * 去除js模板中的空白字符
	 * @param $tpl
	 * @return string
	 */
	protected function trimJsTpl($tpl)
	{
		if(empty($tpl) || !is_string($tpl))
		{
			return '';
		}
		/* 去除html空格与换行 */
		$find     = array("~<!--.*-->~", "~>\s+<~","~>(\s+\n|\r)~", "~}}\s+{{~","~}}(\s+\n|\r)~", "~>\s+{{~", '~}}\s+<~');
		$replace  = array('', '><','>', '}}{{', '}}', '>{{', '}}<');
		return preg_replace($find, $replace, $tpl);
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

	public function staticHost()
	{
		return config('setting.static_host');
	}

	public function json_encode($array)
	{
		$json = json_encode($array);
		return $json ?: 'null';
	}

	public function encryptEmailToken($rawToken, $email)
	{
		return Yutils::getInstance()->encryptEmailToken($rawToken, $email);
	}

//	/**
//	 * @param string $url 图片的url
//	 * @param int $w 目标图片宽
//	 * @param int $h 目标图片高
//	 * @param string $quality 图片质量
//	 * @param int $type 剪切类型：1->强制缩放;2->等比缩放;3->中心剪切
//	 *
//	 * @return string
//	 */
//	public function resizeImage($url, $w=0, $h=0, $type=2, $quality='')
//	{
//		return ImageHelper::getInstance()->resize($url, $w, $h, $type, $quality);
//	}

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

	public function navMenuActive($menu, $active)
	{
		return $menu === $active ? "active" : "";
	}

	public function timeFormat($time)
	{
        return date("Y-m-d H:i:s", $time?:time());
	}

	public function pagination($page, $maxPage, $category=NULL)
	{
        $str = <<<PAGINATION
<div class="pagination">
        <a href="http://ymblog.net/">最前</a>
        <a href="http://ymblog.net/page/6/">上一页</a>
        <a href="http://ymblog.net/page/5/" class="inactive">5</a>
        <a href="http://ymblog.net/page/6/" class="inactive">6</a>
        <span class="current">7</span>
    </div>
PAGINATION;
        $html = [];
        $html[] = '<div class="pagination">';
        for($i=1;$i<=$maxPage;$i++)
        {
            $html[] = $i == $page
                ? sprintf('<span class="current">%s</span>', $i)
                : sprintf("<a href='/article/timeline?page=%1\$s%3\$s' class='%2\$s'>%1\$s</a>", $i, "", $category?"&category={$category}":"");
        }
        $html[] = '</div>';

        return implode('', $html);
	}

}