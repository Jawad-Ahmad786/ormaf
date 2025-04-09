<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Http\Requests\Signup\StoreRequest;
use App\Http\Requests\Signup\UpdateRequest;
use App\Models\LogicModel;
use App\Services\DepartmentService;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected SubscriptionService $subscriptionService;

    protected DepartmentService $departmentService;

    public function __construct(SubscriptionService $subscriptionService, DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
        $this->subscriptionService= $subscriptionService;
    }

    public function create() {
        $countries = Country::all();
        return view('auth.free_signup', compact('countries'));

    }
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

     try {

        $data = $request->validated();
        $data['terms_conditions'] = $request->terms_conditions ? 1 : 0;

        $user = User::create([
            'country_id' => $data['country'],
            'state_id'  => $data['state'],
            'city_id' => $data['city'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'zip_code' => $data['zip_code'],
            'address' => $data['address'],
            'terms_conditions' => $data['terms_conditions']
        ]);

    // Create Subscription
            $this->subscriptionService->store($user->id);

    // Create Department
           $department = $this->departmentService->store($user->id, $data['organization_name']);

           LogicModel::create([
                'department_id' => $department->id
           ]);

            event(new Registered($user));

            DB::commit();

        return redirect(route('login', ['locale' =>app()->getLocale()]));

    }
    catch(\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'something went wrong');
     }
    }
}
