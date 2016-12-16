<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $entities = [
        'User',
        'Article',
        'Page',
        'Category',
        'Role',
        'Permission',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->entities as $entity) {
            $this->{"bind" . $entity . "Repository"}();
        }
    }

    protected function bindArticleRepository()
    {
        $this->app->bind(
            'App\Http\Repositories\Articles\ArticleRepository',
            'App\Http\Repositories\Articles\EloquentArticleRepository'
        );
    }

    protected function bindCategoryRepository()
    {
        $this->app->bind(
            'App\Http\Repositories\Categories\CategoryRepository',
            'App\Http\Repositories\Categories\EloquentCategoryRepository'
        );
    }

    protected function bindUserRepository()
    {
        $this->app->bind(
            'App\Http\Repositories\Users\UserRepository',
            'App\Http\Repositories\Users\EloquentUserRepository'
        );
    }

    protected function bindRoleRepository()
    {
        $this->app->bind(
            'App\Http\Repositories\Roles\RoleRepository',
            'App\Http\Repositories\Roles\EloquentRoleRepository'
        );
    }

    protected function bindPermissionRepository()
    {
        $this->app->bind(
            'App\Http\Repositories\Permissions\PermissionRepository',
            'App\Http\Repositories\Permissions\EloquentPermissionRepository'
        );
    }

    protected function bindPageRepository()
    {
        $this->app->bind(
            'App\Http\Repositories\Pages\PageRepository',
            'App\Http\Repositories\Pages\EloquentPageRepository'
        );
    }
}
