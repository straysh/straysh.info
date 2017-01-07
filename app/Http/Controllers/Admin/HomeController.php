<?php namespace App\Http\Controllers\Admin;

session_check();

use App\Http\Models\Frontend\Article;
use App\Http\Models\Frontend\Option;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends AdminBaseController
{

    /**
     * Admin dashboard.
     *
     * @return \Response
     */
    public function getIndex()
    {
        return view('admin.home.index');
    }

    /**
     * Logout.
     *
     * @return \Response
     */
    public function getLogout()
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
    public function getSettings()
    {
//        if (! defined('STDIN')) {
//            $stdin = fopen("php://stdin", "r");
//        }

        return view('admin.settings');
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
     * @param  int $idFormFacade
     * @return mixed
     */
    public function getArticle($id)
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
