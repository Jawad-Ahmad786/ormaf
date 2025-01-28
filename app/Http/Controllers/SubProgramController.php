<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubPrograms\StoreRequest;
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
}
