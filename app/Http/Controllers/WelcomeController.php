<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Objective;
use App\Models\Program;
use App\Models\User;
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

         $countries = Country::all();
         $teamMembers = User::where('added_by', Auth::user()->id)->get() ?? null;
         return view('signin.wiz3', compact('countries', 'teamMembers'));
    }

    public function wizFour() {

        $objectives = Auth::user()->department->objectives;
        $programs = Auth::user()->programs ?? null;
        $programMembers = User::where('added_by', Auth::user()->id)->get() ?? null;
        return view('signin.wiz4', compact('objectives', 'programs', 'programMembers'));

    }

    public function wizEnd() {

        return view('signin.wizend');

    }

}
