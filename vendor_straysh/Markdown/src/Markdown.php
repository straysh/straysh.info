<?php namespace Straysh\Markdown;
/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-28
 * Time: 下午3:46
 */

class Markdown
{

    public static function markdownPhase($str, $closeTags=['', ''])
    {
        $parseDown = new Parsedown();
        $str = $parseDown->text($str);
        return "{$closeTags[0]}{$str}{$closeTags[1]}";
    }

}