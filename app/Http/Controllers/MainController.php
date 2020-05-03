<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Reason;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{

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


        $key = 'array_transaction';

        //было 110 запросов(778ms), стало 2 (264ms)
        $arTransactions = Cache::remember($key, 60, function () use ($students, $reasons) {
            foreach ($students as $student) {
                foreach ($reasons as $reason) {
                    $arTransactions[$student['id']][$reason['id']] = Transaction::where('student_id', $student['id'])->where('reason_id', $reason['id'])->pluck('amount')->first();
                }
            }
            return $arTransactions;
        });


//        dd($reasons);

        return view('layouts.page_main', [
            'students' => $students,
            'reasons' => $reasons,
            'reasonsCount' => $reasonsCount,
            'arTransactions' => $arTransactions
        ]);
    }
}
