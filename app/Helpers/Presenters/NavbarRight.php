<?php namespace App\Helpers\Presenters;

use App\Helpers\Menus\Presenters\Bootstrap\NavbarRightPresenter;

class NavbarRight extends NavbarRightPresenter
{

    /**
     * {@inheritdoc }
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return '<li class="dropdown ' . $this->getActiveStateOnChild($item, ' active') . '">
			      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					' . $item->getIcon() . ' ' . $item->title . '
			      	<b class="caret"></b>
			      </a>
			      <ul class="dropdown-menu">
			      	' . $this->getChildMenuItems($item) . '
			      </ul>
		      	</li>'
        . PHP_EOL;
        ;
    }
}
