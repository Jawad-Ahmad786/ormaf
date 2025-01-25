<?php

namespace App\Http\Controllers;
use App\Models\Objective;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index() {

        return view('signin.welcome');

    }

    public function wizOne() {
        $department = Auth::user()->department;
        return view('signin.wiz1', compact('department'));
    }

    public function wizTwo(string $locale) {

        $objectives = Auth::user()->department->objectives ?? null;
        return view('signin.wiz2', compact('objectives'));
    }

    public function wizThree() {

        $objectives = Auth::user()->department->objectives;
        $programs = Program::where('user_id', Auth::user()->id)->get();
        return view('signin.wiz3', compact('objectives', 'programs'));
    }

    public function wizFour() {

        return view('signin.wiz4');

    }

    public function wizEnd() {

        return view('signin.wizend');

    }

}
