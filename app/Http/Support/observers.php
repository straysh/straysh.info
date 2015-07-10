<?php

Event::listen('backend::routes', 'App\Helpers\Observers\RoutesObserver');

Event::listen('backend::visitors.track', 'App\Helpers\Observers\VisitorObserver');

Event::listen('backend::menus', 'App\Helpers\Observers\MenusObserver');
