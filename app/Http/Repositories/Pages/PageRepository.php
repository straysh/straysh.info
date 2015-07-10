<?php namespace App\Http\Repositories\Pages;

use App\Http\Repositories\Repository;

interface PageRepository extends Repository
{
    public function getPage();
}
