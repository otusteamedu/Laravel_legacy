<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\User;

use App\Services\User\UserService;
use App\Services\Student\StudentService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gate;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{

    protected $userService;
    protected $studentServicel;

    public function __construct(
        UserService $userService,
        StudentService $studentService
    )
    {
        $this->userService = $userService;
        $this->studentService = $studentService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.index', [
            'students' => $this->studentService->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create', [
            'students' => [],
//            'users' => User::all(),
            'users' => $this->userService->all(),
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
        $locale = \App::getLocale();//TODO получить из мидлвара
        $this->studentService->create($request);
        return redirect()->route('admin.student.index', ['locale'=>$locale]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('student.show', [
            'student' => $student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {

        if (Gate::denies('is-owner', $student)) {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }

        return view('student.edit', [
            'student' => $student,
//            'users' => User::all(),
            'users' => $this->userService->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $locale = \App::getLocale();//TODO получить из мидлвара

        if (Gate::denies('is-owner', $student)) {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }


        $student->update($request->except('user_id'));
        $student->users()->detach();
        if ($request->input('user_id')) {
            $student->users()->attach($request->input('user_id'));
        }

        return redirect()->route('admin.student.index', ['locale'=>$locale]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if (Gate::denies('is-owner', $student)) {
            Log::critical("сообщение в слак о попытке дотупа");
            return view('errors.not-allowed');
        }

        $locale = \App::getLocale();//TODO получить из мидлвара
        $student->users()->detach();
        $student->delete();
        return redirect()->route('admin.student.index', ['locale'=>$locale]);
    }
}
