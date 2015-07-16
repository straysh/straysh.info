<?php namespace App\Http\Controllers\Backend;

session_check();

use Illuminate\Http\Request;
use Pingpong\Admin\Entities\Article;
use Pingpong\Admin\Entities\Option;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiteController extends BackendController
{

    /**
     * Admin dashboard.
     *
     * @return \Response
     */
    public function index()
    {
        return view('backend.index');
    }

    /**
     * Logout.
     *
     * @return \Response
     */
    public function logout()
    {
        \Auth::logout();

        unset($_SESSION['admin']);

        return redirect('login.index');
    }

    /**
     * Settings Page.
     *
     * @return \Response
     */
    public function settings()
    {
//        if (! defined('STDIN')) {
//            $stdin = fopen("php://stdin", "r");
//        }

        return view('backend.settings');
    }

    /**
     * Reinstall the application.
     *
     * @return mixed
     */
    public function reinstall()
    {
        \Artisan::call('migrate:refresh');

        \Artisan::call('db:seed');

        return $this->redirect('settings')->withFlashMessage('Reinstalled success!');
    }

    /**
     * Clear the application cache.
     * @return mixed
     */
    public function clearCache()
    {
        \Artisan::call('cache:clear');

        return $this->redirect('settings')->withFlashMessage('Application cache cleared!');
    }

    /**
     * Update the settings.
     * @param Request $request
     * @return mixed
     */
    public function updateSettings(Request $request)
    {
        $settings = $request->all();

        foreach ($settings as $key => $value) {
            $option = str_replace('_', '.', $key);

            Option::findByKey($option)->update([
                'value' => $value
            ]);
        }

        return redirect()->back()->withFlashMessage('Settings has been successfully updated!');
    }

    /**
     * Show article.
     *
     * @param  int $id
     * @return mixed
     */
    public function showArticle($id)
    {
        try {
            $post = Article::with('user', 'category')
                           ->whereId(intval($id))
                           ->orWhere('slug', $id)
                           ->firstOrFail();

            $view = config('admin.views.post');

            return view($view, compact('post'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
        return false;
    }
}
