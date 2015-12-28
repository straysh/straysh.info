<?php namespace App\Http\Helpers\Presenters;

use App\Http\Models\Frontend\FrontendModel;

class Model extends FrontendModel implements PresentableInterface
{
    use PresentableTrait;
}
