<?php

namespace App\Services\Cache;

use Cache;
use DB;
use App\Models\Student;
use App\Models\Reason;
use App\Models\Transaction;

class CacheService
{
    public function clear()
    {
        Cache::flush();
    }

    public function clearTransactionTable()
    {
        Cache::tags(['array_transaction_tag'])->flush();
        return 'Кэша таблицы очищен';
    }

    public function clearKey($key)
    {
        if (!empty($key)) {
            Cache::forget($key);
        }
    }

    public function heating()
    {
        $grammar = Grammar::all();
        Cache::put('grammar_list', $grammar, 600);
        foreach ($grammar as $item) {
            Grammar::find($item->id);
            Cache::tags(['grammar'])->put('grammar_detail_' . $item->id, $item, 600);
        }
    }

    public function warmTransactionTable()
    {
        $key = 'array_transaction';

        $students = Student::all();
        $reasons = Reason::all();

        foreach ($students as $student) {
            foreach ($reasons as $reason) {
                $arTransactions[$student['id']][$reason['id']] = Transaction::where('student_id', $student['id'])->where('reason_id', $reason['id'])->pluck('amount')->first();
            }
        }
        Cache::put($key, $arTransactions, 600);
    }
}