<?php

Menu::create('admin-menu', function ($menu) {
    $menu->enableOrdering();
    $menu->setPresenter('App\Http\Helpers\Presenters\SidebarMenuPresenter');
    $menu->route('home', trans('menus.dashboard'), [], 0, ['icon' => 'fa fa-dashboard']);
    $menu->dropdown(trans('menus.articles.title'), function ($sub) {
        $sub->route('articles.index', trans('menus.articles.all'), [], 1);
        $sub->route('articles.create', trans('menus.articles.create'), [], 2);
        $sub->divider(3);
        $sub->route('categories.index', trans('menus.categories'), [], 4);
    }, 1, ['icon' => 'fa fa-book']);
    $menu->dropdown(trans('menus.pages.title'), function ($sub) {
        $sub->route('pages.index', trans('menus.pages.all'), [], 1);
        $sub->route('pages.create', trans('menus.pages.create'), [], 2);
    }, 2, ['icon' => 'fa fa-flag']);
    $menu->dropdown(trans('menus.users.title'), function ($sub) {
        $sub->route('users.index', trans('menus.users.all'), [], 1);
        $sub->route('users.create', trans('menus.users.create'), [], 2);
        $sub->divider(3);
        $sub->route('roles.index', trans('menus.roles'), [], 4);
        $sub->route('permissions.index', trans('menus.permissions'), [], 5);
    }, 3, ['icon' => 'fa fa-users']);
});
