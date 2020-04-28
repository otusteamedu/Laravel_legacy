<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Student;
use App\Models\Reason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('before', Transaction::class);
        return view('transaction.index', [
            'transactions' => Transaction::orderBy('id', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('before', Transaction::class);
        return view('transaction.create', [
            'students' => Student::all(),
            'users' => User::all(),
            'reasons' => Reason::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('before', Transaction::class);
        Transaction::create($request->all());
        return redirect()->route('admin.transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('before', Transaction::class);
        return view('transaction.show', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $this->authorize('before', Transaction::class);
        return view('transaction.edit', [
            'transaction' => $transaction,
            'students' => Student::all(),
            'users' => User::all(),
            'reasons' => Reason::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('before', Transaction::class);
        $transaction->update($request->all());
        return redirect()->route('admin.transaction.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('before', Transaction::class);
        $transaction->delete();
        return redirect()->route('admin.transaction.index');

    }
}
