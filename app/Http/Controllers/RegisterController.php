<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Http\Requests\Signup\StoreRequest;
use App\Services\DepartmentService;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

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
        $addedBy = null;

    if ($request->added_by) {

            $subscription = Auth::user()->subscription;
            $subscription->user_create_limits -= 1;
            $subscription->save();
            $limit = $subscription->user_create_limits;
            $addedBy = (int)$request->added_by;

         if ($limit < 0) {
            return response()->json(['error' => 'Your limit for creating members exceeds'], 400);
           }
      }

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
            'added_by' => $addedBy,
            'terms_conditions' => $data['terms_conditions']
        ]);

if ($request->is_direct_signup) {
    // Create Subscription
            $this->subscriptionService->store($user->id);

    // Create Department
            $this->departmentService->store($user->id, $data['organization_name']);

            event(new Registered($user)); // Trigger the email verification notification

}
            DB::commit();

if ($request->added_by) {

        return response()->json([
            'success' => true,
            'message' => 'Member has been added successfully'
        ]);

    }

        return redirect(route('login', ['locale' =>app()->getLocale()]));

    }
    catch(\Exception $e) {
        DB::rollBack();
        return back()->with('error', $e->getMessage());
     }
    }
}
