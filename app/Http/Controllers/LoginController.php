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
         return redirect(route('home', ['locale' => app()->getLocale()]));
      } else {
        return redirect()->back()->with('error', 'These credentials do not match our records');
      }
   }
}
