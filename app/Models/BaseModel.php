<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-30
 * Time: 下午4:27
 */
abstract class BaseModel extends Model
{
    protected function concatOrder(Builder $sql, $params)
    {
        if (!empty($params['orderby'])) {
            $sql->orderByRaw($params['orderby']);
        } else {
            $sql->orderByRaw('created_at DESC');
        }

        return $sql;
    }

    protected function parseMaxpage(Builder $sql, Paginator $results, $options)
    {
        if (1 === $options['page']) {
            $results->maxPage = (int)!$results->isEmpty();

            if ($results->hasMorePages()) {
                $total = $sql->count('*');
                $results->maxPage = (int)ceil($total / $options['limit']);
            }
        } else {
            $results->maxPage = null;
        }

        return $results;
    }
}