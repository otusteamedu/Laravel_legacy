<?php


namespace App\Repositories;

use App\Models\Operation;

class OperationRepository
{

    public function storeOperation($data, Operation $operation){
        $operation->create([
            'sum' => $data['sum'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function updateOperation($data, Operation $operation){
        $operation->update([
            'sum' => $data['sum'],
            'category_id' => $data['category_id'],
            'description' => $data['description']
        ]);
    }

    public function destroyOperation($id, Operation $operation){
        $operation->destroy($id);
    }

    public function getUserOperationsForPeriod($userId, $dateStart, $dateEnd){
        return Operation::where('user_id', $userId)->whereBetween('updated_at', [$dateStart, $dateEnd])->with('category')->get();
    }
}