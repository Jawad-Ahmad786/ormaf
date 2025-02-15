<?php

namespace App\Services;
use App\Models\LogicModelComponent;

class LogicModelComponentsService {

    public function store(array $data, int $logicModelId): bool {

    try {
        LogicModelComponent::create([
            'logic_model_component_type_id' => 1,
            'logic_model_id' => $logicModelId,
            'name' => $data['name']
        ]);
            return true;

     }  catch (\Exception $exception) {
             return false;
     }
    }

    public function update(array $objective) {
        try {
            LogicModelComponent::where('id', $objective['id'])->update($objective);
                return true;

         }  catch (\Exception $exception) {
                 return false;
         }
    }
}
