<?php

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 28.04.2020
 * Time: 9:33
 */
namespace App\Services\Transaction;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class TransactionService
{

    /**
     * получаем данные для построения таблицы кто сколько сдал
     * @return Collection
     */
    public function GetMainTable($students, $reasons)
    {

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
    }

}