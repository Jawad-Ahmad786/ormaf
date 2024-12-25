<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {

        return view('signin.welcome');

    }

    public function wizOne() {

        return view('signin.wiz1');

    }

    public function wizTwo() {

        return view('signin.wiz2');

    }

    public function wizThree() {

        return view('signin.wiz3');

    }

    public function wizFour() {

        return view('signin.wiz4');

    }

    public function wizEnd() {

        return view('signin.wizend');

    }

}
