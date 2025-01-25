<?php

namespace App\Http\Controllers;

use App\Http\Requests\Programs\StoreRequest;
use App\Services\ProgramsService;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
     protected ProgramsService $programService;

     public function __construct(ProgramsService $programService)
     {
        $this->programService = $programService;
     }

     public function store(string $locale, StoreRequest $request) {

        $data = $request->validated();
        $data['parent'] = $request->parent ? 1 : 0;

        $program = $this->programService->store($data);

     if (!$program) {
        return response()->json([
            'message' => 'Something went wrong. Please try again.',
        ], 500);
    }

    return response()->json([
        'message' => 'Program created successfully!',
        'redirect' => route('wiz4', ['locale' => app()->getLocale()]),
    ], 200);
     }
}
