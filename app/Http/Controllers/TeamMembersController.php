<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamMembers\StoreRequest;
use App\Http\Requests\TeamMembers\UpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

           if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('Users', 'public');
                $data['image'] = $imagePath;
            }

           $user = User::create([
               'first_name' => $data['first_name'],
               'last_name' => $data['last_name'],
               'email' => $data['email'],
               'added_by' => Auth::user()->id,
               'image' => $data['image'] ?? null,
               'terms_conditions' => $data['terms_conditions']
           ]);

               event(new Registered($user));
               DB::commit();

           return response()->json([
               'success' => true,
               'message' => 'Member added successfully'
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

      if ($request->hasFile('image')) {
        if ($user->image) {
            $oldImagePath = $user->getRawOriginal('image');
            if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }
        $imagePath = $request->file('image')->store('Users', 'public');
        $data['image'] = $imagePath;
    }

      $user->update($data);

      return response()->json([
        'success' => true,
         'message' => 'Member Updated Successfully'
      ]);
    }
    public function destroy(string $locale, User $user) {

        $currentUser = Auth::user();

        if ($user->added_by === $currentUser->id) {

            $user->programMembers()->detach();
            $user->subprogramMembers()->detach();
         if($user->image) {
            $imagePath = $user->getRawOriginal('image');
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
         }
            $user->delete();

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
