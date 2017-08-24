<?php
/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-9
 * Time: 下午4:22
 */

use Illuminate\Support\Debug\Dumper;

if (!function_exists('dde')) {
    /**
     * var_dump and exit
     *
     * @return void
     */
    function dde()
    {
        $args = func_get_args();
        foreach ($args as $v) {
            var_export($v);
            echo PHP_EOL;
        }
        exit;
    }
}

if (! function_exists('ddd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function ddd(...$args)
    {
        foreach ($args as $x) {
            (new Dumper)->dump($x);
        }
    }
}