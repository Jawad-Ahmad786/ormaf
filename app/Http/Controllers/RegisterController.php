<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\Register\StoreRequest;
use App\Models\LogicModel;
use App\Services\DepartmentService;
use App\Services\RegisterService;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected SubscriptionService $subscriptionService;

    protected DepartmentService $departmentService;

    protected RegisterService $registerService;

    public function __construct(SubscriptionService $subscriptionService, DepartmentService $departmentService, RegisterService $registerService)
    {
        $this->departmentService = $departmentService;
        $this->subscriptionService= $subscriptionService;
        $this->registerService = $registerService;
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

        $user = $this->registerService->store($data);

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
