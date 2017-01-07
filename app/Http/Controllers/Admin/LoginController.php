<?php namespace App\Http\Controllers\Admin;

session_check();
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends AdminBaseController
{

    /**
     * Show login page.
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * Login action.
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $_SESSION['admin'] = Auth::id();

            return redirect()->route('home')->withFlashMessage('Login Success!');
        }

        return redirect()->back()->withFlashMessage("Login failed!")->withFlashType('danger');
    }
}
