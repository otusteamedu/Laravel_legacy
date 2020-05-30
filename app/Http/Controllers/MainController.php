<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Reason;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\Transaction\TransactionService;

class MainController extends Controller
{

    private $transactionService;

    public function __construct(
        TransactionService $transactionService
    )
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $reasons = Reason::all();

        $reasonsCount = count($reasons);

        $arTransactions = $this->transactionService->GetMainTable($students, $reasons);

        return view('layouts.page_main', [
            'students' => $students,
            'reasons' => $reasons,
            'reasonsCount' => $reasonsCount,
            'arTransactions' => $arTransactions
        ]);
    }
}
