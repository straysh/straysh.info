<?php namespace App\Helpers\Presenters;

use App\Models\Frontend\FrontendModel;

class Model extends FrontendModel implements PresentableInterface
{
    use PresentableTrait;
}
