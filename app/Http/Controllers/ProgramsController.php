<?php

namespace App\Http\Controllers;

use App\Http\Requests\Programs\StoreRequest;
use App\Http\Requests\Programs\UpdateRequest;
use App\Models\Program;
use App\Services\ProgramsService;
use Illuminate\Support\Facades\Auth;

class ProgramsController extends Controller
{
     protected ProgramsService $programService;

     public function __construct(ProgramsService $programService)
     {
        $this->programService = $programService;
     }

     public function store(string $locale, StoreRequest $request) {

        $data = $request->validated();
        $data['has_subprograms'] = $request->has_subprograms ? 1 : 0;

        $program = $this->programService->store($data);

       //   Create Logic Modal of a program
        $program->logicModel()->create([
            'department_id' => Auth::user()->department->id,
        ]);

        // Add Team Members
        $program->members()->attach($request->members);

     if (!$program) {
        return response()->json([
            'message' => 'Something went wrong. Please try again.',
        ], 500);
    }

    return response()->json([
        'message' => 'Program created successfully!',
    ], 200);
     }

    public function update(string $locale, UpdateRequest $request, Program $program) {

        $data = $request->validated();
        $data['has_subprograms'] = $request->has_subprograms ? 1 : 0;

        $programUpdate = $this->programService->update($data, $program->id);

        // Add Team Members
      if($programUpdate){

        if ($request->has('members')) {
            $program->members()->sync($request->members);
        }
         else {
            $program->members()->sync([]);
        }
        if($data['has_subprograms'] && $program->subPrograms()->exists()){
            $program->subPrograms()->delete();
      }
      }

     if (!$program) {
        return response()->json([
            'message' => 'Something went wrong. Please try again.',
        ], 500);
    }

    return response()->json([
        'message' => 'Program updated successfully!',
    ], 200);
     }

    public function destroy(string $locale, Program $program) {

        $program->members()->detach();
        $program->subPrograms()->delete();
        $program->delete();
        return response()->json([
            'success' => true,
            'message' => 'Program deleted successfully'
        ]);
    }
}
