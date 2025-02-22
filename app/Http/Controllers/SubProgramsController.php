<?php

namespace App\Http\Controllers;
use App\Http\Requests\SubPrograms\StoreRequest;
use App\Http\Requests\SubPrograms\UpdateRequest;
use App\Models\SubProgram;
use App\Services\SubProgramsService;
use Illuminate\Support\Facades\Auth;

class SubProgramsController extends Controller
{
    protected SubProgramsService $subProgramsService;

    public function __construct(SubProgramsService $subProgramsService)
    {
        $this->subProgramsService = $subProgramsService;
    }

    public function store(StoreRequest $request) {

        $data = $request->validated();

        $subProgram = $this->subProgramsService->store($data);

        $subProgram->logicModel()->create([
            'department_id' => Auth::user()->department->id,
            'program_id' => $data['program_id']
        ]);

        // Add Team Members
        $subProgram->members()->attach($request->members);

     if (!$subProgram) {
        return response()->json([
            'message' => 'Something went wrong. Please try again.',
        ], 500);
    }

    return response()->json([
        'message' => 'Subprogram created successfully!',
    ], 200);
     }

    public function update(string $locale, UpdateRequest $request, SubProgram $subprogram) {

        $data = $request->validated();

        $subProgramUpdate = $this->subProgramsService->update($data, $subprogram);

        // Add Team Members
      if($subProgramUpdate){
        if ($request->has('members')) {
            $subprogram->members()->sync($request->members);
        }
         else {
            $subprogram->members()->sync([]);
        }
      }

     if (!$subprogram) {
        return response()->json([
            'message' => 'Something went wrong. Please try again.',
        ], 500);
    }

    return response()->json([
        'message' => 'Subprogram updated successfully!',
    ], 200);
     }

    public function destroy(string $locale, SubProgram $subprogram) {

        $subprogram->members()->detach();
        $subprogram->logicModel()->delete();
        $subprogram->delete();
        return response()->json([
            'success' => true,
            'message' => 'Subprogram deleted successfully'
        ]);
    }
}
