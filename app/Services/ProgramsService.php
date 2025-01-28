<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use Carbon\Carbon;

class ProgramsService {

    public function store(array $data) {
          try {
            return Program::create([
                'name' => $data['name'],
                'value' => $data['value'],
                'manager_id' => Auth::user()->id,
                'objective_id' => $data['objective'],
                'branch_id' => 0,
                'whole_of_govt_id' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addWeek(),
                'parent' => $data['parent']
            ]);
          }
          catch (\Exception $e) {

            return false;
          }
    }
}
