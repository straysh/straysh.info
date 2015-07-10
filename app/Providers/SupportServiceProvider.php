<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class SupportServiceProvider extends ServiceProvider
{

//    /**
//     * The class aliases array.
//     *
//     * @var array
//     */
//    protected $aliases = [
//        'Image' => 'Intervention\Image\Facades\Image'
//    ];
//
//    /**
//     * The service provider classes array.
//     *
//     * @var array
//     */
//    protected $providers = [
//        'Intervention\Image\ImageServiceProvider',
//    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/../Http/Support/permissions.php';
        require __DIR__ . '/../Http/Support/observers.php';
        require __DIR__ . '/../Http/Support/menus.php';
        require __DIR__ . '/../Http/Support/routes.php';

        if (file_exists($path = config('menus.menus'))) {
            require $path;
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
//        $this->registerProviders();
//        $this->registerAliases();
    }

    /**
     * Register service providers.
     *
     * @return void
     */
    public function registerProviders()
    {
        dd($this->providers);
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register class aliases.
     *
     * @return void
     */
    public function registerAliases()
    {
        AliasLoader::getInstance($this->aliases)->register();
    }
}
