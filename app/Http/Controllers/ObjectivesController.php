<?php

namespace App\Http\Controllers;

use App\Http\Requests\Objectives\StoreRequest;
use App\Services\ObjectivesService;
use Illuminate\Support\Facades\Auth;
use App\Models\Objective;

class ObjectivesController extends Controller
{
    protected ObjectivesService $objectivesService;

    public function __construct(ObjectivesService $objectivesService)
    {
        $this->objectivesService = $objectivesService;
    }

    public function store(string $locale, StoreRequest $request) {

        $data = $request->validated();
        $departmentId = Auth::user()->department->id;
        $objective = $this->objectivesService->store($data, $departmentId);

    if(!$objective) {

        return back()->with('error', 'something went wrong');
     }
        return redirect()->route('wiz2', ['locale' => app()->getLocale()]);
    }

    public function destroy(string $locale, Objective $objective) {

        $objective->delete();
        return response()->json(['message' => 'Objective Deleted Successfully']);
    }
}
