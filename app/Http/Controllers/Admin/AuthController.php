<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    protected $guard = 'admin';
    protected $username = 'username';
    public function login()
    {
        return view('Admin.auth.login');
    }

    public function loginPost(Request $request)
    {

        $this->validateLogin($request);
        if (isset($request['username']) && isset($request['password'])) {
            $admin = Admin::where('email', $request['username'])->first();
            // dd($admin);
            if (!$admin) {
                $request->session()->flash('error', 'Please enter valid email id');
                return redirect()
                    ->route('admin.login');
                // ->withErrors([
                //     $this->loginUsername() => 'Please enter valid email id',
                // ]);
            }
            $auth = auth()->guard('admin');
            $validCredentials = Hash::check($request['password'], $admin->password);

            if (!$validCredentials) {
                $request->session()->flash('error', 'Password you\'ve entered is incorrect');
                return redirect()
                    ->route('admin.login');
                // ->withErrors([
                //     'password' => 'Password you\'ve entered is incorrect',
                // ]);
            }
            $credentials = [
                'email' => $request['username'],
                'password' => $request['password']
            ];
            $remember_me = $request['remember'] ? true : false;
            if ($auth->attempt($credentials, $remember_me)) {
                return redirect(route('admin.dashboard'));
            } else {
                return $this->sendFailedLoginResponse($request);
            }
        } else {
            return view('Admin.auth.login');
        }

    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->loginUsername() => 'required',
            'password' => 'required',
        ], [
            $this->loginUsername() . '.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ]);
    }

    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? Lang::get('auth.failed')
            : 'Please add correct data.';
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('admin.login')
            ->with('status', 'Admin has been logged out!');
    }
}
