<?php namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * The providers package.
     *
     * @var array
     */
    protected $providers = [
        'App\Http\Composers\ComposerServiceProvider',
        'App\Providers\SupportServiceProvider',
        'App\Helpers\Menus\MenusServiceProvider',
        'App\Providers\RepositoriesServiceProvider',
//        'Pingpong\Trusty\TrustyServiceProvider',
//        'Pingpong\Admin\Providers\ConsoleServiceProvider',
//        'Pingpong\Admin\Providers\RepositoriesServiceProvider',
    ];

    /**
     * The facades package.
     *
     * @var array
     */
    protected $facades = [
        'Menu' => 'App\Helpers\Menus\MenuFacade',
//        'Role' => 'Pingpong\Trusty\Entities\Role',
//        'Permission' => 'Pingpong\Trusty\Entities\Permission',
//        'Trusty' => 'Pingpong\Trusty\Facades\Trusty',
    ];

    /**
     * Register the providers.
     *
     * @return void
     */
    public function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register the facades.
     *
     * @return void
     */
    public function registerFacades()
    {
        AliasLoader::getInstance($this->facades);
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
//        $viewPath = base_path('resources/views/backend/admin/');
//        $this->loadViewsFrom([$viewPath, __DIR__.'/../../views'], 'backend');
//        $configPath = config_path('admin.php');

//        $this->publishes([
//            __DIR__ . '/../../config/config.php' => $configPath,
//        ], 'config');
//
//        $this->publishes([
//            __DIR__ . '/../../../public/' => public_path('packages/pingpong/admin/')
//        ], 'assets');
//
//
//        $this->publishes([
//            __DIR__ . '/../../views/' => $viewPath
//        ], 'views');
//
//        if (file_exists($configPath)) {
//            $this->mergeConfigFrom($configPath, 'admin');
//        }
//
//
//        $langPath = base_path('resources/lang/en/admin.php');
//
//        $this->publishes([
//            __DIR__ . '/../../lang/admin.php' => $langPath
//        ], 'lang');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();

        $this->registerFacades();

        $this->registerRoutes();
    }

    /**
     * Register events.
     *
     * @return void
     */
    public function registerRoutes()
    {
        $this->app->booted(function () {
            $this->app['events']->fire('backend::routes');//@FIXME
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}