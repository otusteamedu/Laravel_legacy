<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\MyJob;
use App\Jobs\Queue;
use App\Models\Reason;
use App\Models\Student;
use App\Models\Transaction;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reason.index', [
            'reasons' => Reason::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->can('create', Reason::class)) {
            return view('reason.create', [
                'reasons' => [],
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

        if ($user->can()) {
            $reason = Reason::create($request->all());

            //отправка писем всем пользователям
            MyJob::dispatch($reason)->onQueue(Queue::MEDIUM_PRIORITY);

            return redirect()->route('admin.reason.index', ['locale' => $locale]);
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reason $reason
     * @return \Illuminate\Http\Response
     */
    public function show(Reason $reason)
    {
        //утолщаем контроллер
        //получаем список ответственностей за которые уже сдали деньги
//        $handedResponsibilities = [];//сдавшие деньги
//        $flows = Flow::where('reason_id', $reason->id)->get();
//        foreach ($flows as $flow){
//            array_push($handedResponsibilities, $flow->responsibility_id);
//        }
        //закончили утолщать

        return view('reason.show', [
            'reason' => $reason,
            'students' => Student::all(),
//            'handedResponsibilities'=>$handedResponsibilities,
            'transactions' => Transaction::orderBy('created_at', 'desc')->where('reason_id', $reason->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reason $reason
     * @return \Illuminate\Http\Response
     */
    public function edit(Reason $reason)
    {
        $user = Auth::user();


        if ($user->can('update', $user, Reason::class)) {
            return view('reason.edit', [
                'reason' => $reason
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
     * @param  \App\Models\Reason $reason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reason $reason)
    {
        $user = Auth::user();
        $locale = \App::getLocale();//TODO получить из мидлвара

        if ($user->can('update', $user, Reason::class)) {
            $reason->update($request->all());
            return redirect()->route('admin.reason.index', ['locale' => $locale]);
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reason $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reason $reason)
    {
        $user = Auth::user();
        $locale = \App::getLocale();//TODO получить из мидлвара

        if ($user->can('delete', $user, Reason::class)) {
            $reason->delete();
            return redirect()->route('admin.reason.index', ['locale' => $locale]);
        } else {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }
    }
}
