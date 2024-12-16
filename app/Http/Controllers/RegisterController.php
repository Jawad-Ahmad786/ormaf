<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Signup\StoreRequest;

class RegisterController extends Controller
{
    public function create() {
        return view('auth.free_signup');
    }
    public function store(StoreRequest $request) {
        $data = $request->validated();

         $data['terms_conditions'] = $request->terms_conditions ? 1 : 0;

        $user = User::create($data);
     if($user) {
        return redirect(route('login.create', ['locale' =>app()->getLocale()]));
     }
    }
}
