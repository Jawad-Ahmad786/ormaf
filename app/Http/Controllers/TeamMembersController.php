<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamMembers\StoreRequest;
use App\Http\Requests\TeamMembers\UpdateRequest;
use App\Models\LogicModel;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeamMembersController extends Controller
{

    public function store(StoreRequest $request) {

        DB::beginTransaction();

        try {

            $data = $request->validated();
            $data['terms_conditions'] = $request->terms_conditions ? 1 : 0;
            $subscription = Auth::user()->subscription;
            $subscription->user_create_limits -= 1;
            $subscription->save();
            $limit = $subscription->user_create_limits;

            if ($limit < 0) {
               return response()->json(['error' => 'Your limit for creating members exceeds'], 400);
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
               'added_by' => Auth::user()->id,
               'terms_conditions' => $data['terms_conditions']
           ]);

               event(new Registered($user));
               DB::commit();

           return response()->json([
               'success' => true,
               'message' => 'Member has been added successfully'
           ]);
        }
       catch(\Exception $e) {
           DB::rollBack();
           return back()->with('error', $e->getMessage());
        }

}

    public function edit($locale, User $user)
{

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'Member not found.']);
    }

       return response()->json(['success' => true, 'member' => $user]);
}
    public function update(UpdateRequest $request,$locale, User $user) {

        $data = $request->validated();

      if(is_null($request->password)) {
        unset($data['password']);
      }
      else {
        $data['password'] = Hash::make($data['password']);
      }

      $user->update($data);

      return response()->json([
        'success' => true,
         'message' => 'User Updated Successfully'
      ]);
    }
    public function destroy(string $locale, User $user) {

        $currentUser = Auth::user();

        if ($user->added_by === $currentUser->id) {

            $user->members()->detach();
            $user->delete();

            // Increment user_create_limits
            $currentUser->subscription->user_create_limits += 1;
            $currentUser->subscription->save();

        } else {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong'
            ]);
        }

        return response()->json(['message' => 'Member Deleted Successfully']);
    }
}
