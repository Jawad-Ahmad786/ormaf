<?php

namespace App\Http\Controllers;

use App\Http\Requests\Departments\UpdateRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Storage;

class DepartmentsController extends Controller
{
    protected DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }
    public function update(string $locale, UpdateRequest $request, Department $department) {

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            // Delete the previous image
            if ($department->logo && Storage::disk('public')->exists($department->logo)) {
                Storage::disk('public')->delete($department->logo);
            }

            // Save the new image
            $logoPath = $request->file('logo')->store('Departments', 'public');
            $data['logo'] = $logoPath;
        } else {
            $data['logo'] = $department->logo;
        }

        $departmentUpdate = $this->departmentService->update($department, $data);

     if(!$departmentUpdate) {

            return redirect()->back()->with('error', 'Something went wrong');
     }

       return redirect()->route('wiz2', ['locale' => $locale]);

    }
}
