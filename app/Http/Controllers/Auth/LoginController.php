<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LastLogin;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;


/**
 * Class LoginController
 *
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /**
     * Index page login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('site.auth.login');
    }

    /**
     * Auth user
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function auth(Request $request)
    {
        if (Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password,
            'confirm'  => 1,
        ], $request->remember)) {

            $last = LastLogin::updateOrCreate(['user_id' => Auth::id()]);
            $last->touch();

            return redirect()->intended();
        }

        return redirect('login');
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}