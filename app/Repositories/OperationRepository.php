<?php


namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;

class OperationRepository
{
    public function store(Request $request, Operation $operation){
        $operation->create([
            'sum' => $request->input('sum'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
        ]);
    }

    public function update(Request $request, Operation $operation){
        $operation->update([
            'sum' => $request->input('sum'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
        ]);
    }
}