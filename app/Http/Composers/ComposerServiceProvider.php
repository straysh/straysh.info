<?php namespace App\Http\Composers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('backend.articles.form', __NAMESPACE__.'\\ArticleFormComposer');
		view()->composer('backend.*', __NAMESPACE__.'\\LayoutComposer');
		view()->composer('backend.users.form', __NAMESPACE__.'\\UserFormComposer');
		view()->composer('backend.roles.form', __NAMESPACE__.'\\RoleFormComposer');
		view()->composer('backend.settings', __NAMESPACE__.'\\SettingFormComposer');

//		// Using class based composers...
//		view()->composer(
//			'profile', 'App\Http\ViewComposers\ProfileComposer'
//		);
//
//		// Using Closure based composers...
//		view()->composer('dashboard', function ($view) {
//
//		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}