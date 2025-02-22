<?php

namespace App\Http\Controllers;

use App\Http\Requests\LMComponents\StoreRequest;
use App\Http\Requests\LMComponents\UpdateRequest;
use App\Models\LogicModelComponent;
use App\Services\LogicModelComponentsService;
use Illuminate\Support\Facades\Auth;

class logicModelComponentsController extends Controller
{
    protected LogicModelComponentsService $logicModelComponentsService;

    public function __construct(LogicModelComponentsService $logicModelComponentsService)
    {
        $this->logicModelComponentsService = $logicModelComponentsService;
    }

    public function store(string $locale, StoreRequest $request) {

        $data = $request->validated();
        $logicModelId = Auth::user()->department->logicModel->id;
        $objective = $this->logicModelComponentsService->store($data, $logicModelId);

    if(!$objective) {

        return response()->json([
            'error' => 'Something went wrong'
        ]);
     }
        return response()->json([
            'message' => 'Objective added successfully'
        ]);
    }

    public function edit($locale, LogicModelComponent $logicModelComponent)
{
        return response()->json($logicModelComponent);
}

    public function update(string $locale, UpdateRequest $request, LogicModelComponent $logicModelComponent) {

        $data = $request->validated();
        $data['id'] = $logicModelComponent->id;
        $objective = $this->logicModelComponentsService->update($data);

    if(!$objective) {

        return response()->json([
            'error' => 'Something went wrong'
        ]);
     }
     return response()->json([
        'message' => 'Objective updated successfully'
    ]);
    }

    public function destroy(string $locale, LogicModelComponent $logicModelComponent) {

        $logicModelComponent->delete();
        return response()->json(['message' => 'Objective Deleted Successfully']);
    }
}
