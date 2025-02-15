<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubPrograms\StoreRequest;
use App\Http\Requests\SubPrograms\UpdateRequest;
use App\Models\SubProgram;
use App\Services\SubProgramsService;
use Illuminate\Http\Request;

class SubProgramController extends Controller
{
    protected SubProgramsService $subProgramsService;

    public function __construct(SubProgramsService $subProgramsService)
    {
        $this->subProgramsService = $subProgramsService;
    }

    public function store(StoreRequest $request) {

        $data = $request->validated();
        $subProgram = $this->subProgramsService->store($data);

   if(!$subProgram) {
        return response()->json([
            'error' => 'Something went wrong'
        ], 500);
     }
        return response()->json([
            'success' => true,
            'message' => 'SubProgram added successfully'
        ], 201);
    }

    public function update(string $locale, UpdateRequest $request, SubProgram $SubProgram) {

        $data = $request->validated();
        $this->subProgramsService->update($data, $SubProgram->id);

    return response()->json([
        'message' => 'SubProgram updated successfully!',
    ], 200);
    }

    public function destroy(string $locale, SubProgram $SubProgram) {
        $SubProgram->delete();
        return response()->json([
            'message' => 'Subprogram has been deleted successfully'
        ]);
    }
}
