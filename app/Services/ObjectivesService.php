<?php

namespace App\Services;
use App\Models\Objective;

class ObjectivesService {
    public function store(array $data, int $departmentId): bool {
     try {
        Objective::create([
            'name' => $data['name'],
            'number' => 0,
            'section_id' => 0,
            'department_id' => $departmentId,
            'program_id' => 0,
            'subprog_id' => 0,
            'pms_exist' => 0,
            'rm_exist' => 0,
            'is_default' => 0   
        ]);
            return true;

     }  catch (\Exception $exception) {
             return false;
     }

    }
}
