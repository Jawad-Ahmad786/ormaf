<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProgramsService {

    public function store(array $data) {
          try {
            return Program::create([
                'name' => $data['name'],
                'value' => $data['value'],
                'manager_id' => Auth::user()->id,
                'logic_model_component_id' => $data['objective'],
                'branch_id' => 0,
                'whole_of_govt_id' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addWeek(),
                'has_subprograms' => $data['has_subprograms']
            ]);
          }
          catch (\Exception $e) {
            Log::error($e);  // Or use a more sophisticated logging system
            throw $e;
          }
    }

    public function update(array $data, $programId) {
        try {
            Program::where('id', $programId)->update([
                'name' => $data['name'],
                'value' => $data['value'],
                'manager_id' => Auth::user()->id,
                'logic_model_component_id' => $data['objective'],
                'branch_id' => 0,
                'whole_of_govt_id' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addWeek(),
                'has_subprograms' => $data['has_subprograms']
            ]);

            return true;
        }
        catch (\Exception $e) {
            return false;
        }
  }
}
