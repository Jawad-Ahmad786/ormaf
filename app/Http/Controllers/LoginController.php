<?php

namespace App\Http\Controllers;
use App\Http\Requests\Login\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create() {

        return view('auth.login');

   }

   public function store(StoreRequest $request) {

      $credentials = $request->validated();

      if(Auth::attempt($credentials)) {

         $request->session()->regenerate();

         return redirect(route('welcome', ['locale' => app()->getLocale()]));

      } else {

        return redirect()->back()->with('error', 'These credentials do not match our records');

      }
   }

   public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login', ['locale' => app()->getLocale()]);
   }
}
