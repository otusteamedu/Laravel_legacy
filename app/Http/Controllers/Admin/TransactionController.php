<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Student;
use App\Models\Reason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->can('viewAny', Transaction::class)) {
            return view('transaction.index', [
                'transactions' => Transaction::orderBy('id', 'desc')->paginate(10)
            ]);
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->can('create', Transaction::class)) {
            return view('transaction.create', [
                'students' => Student::all(),
                'users' => User::all(),
                'reasons' => Reason::all()
            ]);
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $locale = \App::getLocale();//TODO получить из мидлвара

        if ($user->can('create', Transaction::class)) {

            Transaction::create($request->all());
            return redirect()->route('admin.transaction.index', ['locale'=>$locale]);

        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $user = Auth::user();

        if ($user->can('view', Transaction::class)) {

            return view('transaction.show', [
                'transaction' => $transaction,
            ]);
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $user = Auth::user();

        if ($user->can('update', $user, Transaction::class)) {

            return view('transaction.edit', [
                'transaction' => $transaction,
                'students' => Student::all(),
                'users' => User::all(),
                'reasons' => Reason::all()
            ]);
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }
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
        $user = Auth::user();

        if ($user->can('update', $user, Transaction::class)) {

            $transaction->update($request->all());
            return redirect()->route('admin.transaction.index');
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $user = Auth::user();

        if ($user->can('delete', Transaction::class)) {

            $transaction->delete();
            return redirect()->route('admin.transaction.index');
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }

    }
}
