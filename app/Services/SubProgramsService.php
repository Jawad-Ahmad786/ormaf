<?php

namespace App\Services;

use App\Models\SubProgram;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SubProgramsService {

    public function store(array $data) {
    try {
        return SubProgram::create([
                'program_id' => $data['program_id'],
                'name' => $data['name'],
                'value' => $data['value'],
                'manager_id' => Auth::user()->id,
                'logic_model_component_id' => $data['objective'],
                'branch_id' => 0,
                'whole_of_govt_id' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addWeek(),
            ]);
          }
          catch (\Exception $e) {
            throw $e;
          }
    }

    public function update(array $data, $subprogram) {

        try {
            $subprogram->update([
                'name' => $data['name'],
                'value' => $data['value'],
                'manager_id' => Auth::user()->id,
                'logic_model_component_id' => $data['objective'],
                'branch_id' => 0,
                'whole_of_govt_id' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addWeek(),
            ]);

             return true;
          }
          catch (\Exception $e) {

            return false;
          }

        }
}
