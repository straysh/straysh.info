<?php

Event::listen('backend::routes', 'App\Http\Helpers\Observers\RoutesObserver');

Event::listen('backend::visitors.track', 'App\Http\Helpers\Observers\VisitorObserver');

Event::listen('backend::menus', 'App\Http\Helpers\Observers\MenusObserver');
