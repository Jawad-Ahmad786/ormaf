<?php

namespace App\Services;

use App\Models\SubProgram;

class SubProgramsService {

    public function store(array $data) {

    try {
        SubProgram::create([
            'program_id' => $data['program_id'],
            'name' => $data['name']
        ]);

         return true;
      }
      catch (\Exception $e) {

        return false;
      }

    }

    public function update(array $data, $subprogramId) {

        try {
            SubProgram::where('id', $subprogramId)->update([
                'name' => $data['name']
            ]);

             return true;
          }
          catch (\Exception $e) {

            return false;
          }

        }
}
