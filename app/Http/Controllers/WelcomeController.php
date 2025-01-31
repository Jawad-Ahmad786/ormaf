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
        $currentUser = Auth::user()->first()->toArray(); // Get the current user's data as an array

        // Merge the arrays but put $currentUser as a single element in the $programManagers array
        $programManagers = array_merge($programMembers->toArray(), [$currentUser]); // Wrap $currentUser in an array

        return view('signin.wiz4', compact('objectives', 'programs', 'programMembers', 'programManagers'));

    }

    public function wizEnd() {

        return view('signin.wizend');

    }

}
