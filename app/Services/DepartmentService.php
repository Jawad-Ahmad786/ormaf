<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService {

    public function store(int $userId, string $departmentName)
    {
        return Department::create([
                'user_id' => $userId,
                'name' => $departmentName,
                'group_by' => 'objectives',
                'no_of_branches' => 3,
                'no_of_obj' => 3,
                'no_of_programs' => 3,
                'dep_pms_exist' => 1,
                'dep_rm_exist' => 1,
                'show_dep' => 1,
                'show_program' => 1,
                'show_subprogram' => 1
        ]);
    }
    public function update(object $department, array $data){
        try {
              $department->update([
                'name' => $data['name'],
                'logo' => $data['logo'],
                'abbrevation' => $data['abbrevation']
           ]);

                 return true;

        } catch(\Exception $e) {

                return false;
        }

    }
}
