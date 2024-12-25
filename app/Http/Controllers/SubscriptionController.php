<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index() {
        return view('subscription.index');
    }
    public function modules() {
        return view('subscription.modules');
    }
    public function plans() {
        return view('subscription.plans');
    }
    public function info() {
        return view('subscription.info');
    }
}
