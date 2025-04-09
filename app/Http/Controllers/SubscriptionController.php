<?php

namespace App\Http\Controllers;

use App\Models\Module;

class SubscriptionController extends Controller
{
    public function modules()
    {
        $modules = Module::with('items')->get();

        return view('subscription.modules', compact('modules'));
    }

    public function selectedModules()
    {
        $modules = Module::with('plans.features')->whereIn('id', request()->moduleIds)->get();
        $annualTab = request()->annualTab;

         session  ([
            'selectedModules' => $modules,
            'annualTab' => $annualTab
        ]);

         return response()->json([
            'redirect_url' => route('subscription.plans', app()->getLocale()),
         ]);
    }

    public function plans()
    {
        $selectedModules = session('selectedModules');
        $annualTab = session('annualTab');
        return view('subscription.plans', compact('selectedModules', 'annualTab'));
    }

    public function info()
    {
        return view('subscription.info');
    }
}
