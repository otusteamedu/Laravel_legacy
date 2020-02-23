<?php


namespace App\Repositories;

use App\Models\Operation;

class OperationRepository
{

    public function storeOperation($data){
        return Operation::create($data);
    }

    public function updateOperation($data, Operation $operation){
        return $operation->update([
            'sum' => $data['sum'],
            'category_id' => $data['category_id'],
            'description' => $data['description']
        ]);
    }

    public function destroyOperation($operation){
        return $operation->delete();
    }

    public function getUserOperationsForPeriod($userId, $dateStart, $dateEnd){
        return Operation::where('user_id', $userId)->whereBetween('updated_at', [$dateStart, $dateEnd])->with('category')->get();
    }
}