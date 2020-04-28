<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\User;

use App\Services\User\UserService;
use App\Services\Student\StudentService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gate;

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
        $this->studentService->create($request);
        return redirect()->route('admin.student.index');
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
            return 'нет прав';
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

        if (Gate::denies('is-owner', $student)) {
            return 'нет прав';
        }


        $student->update($request->except('user_id'));
        $student->users()->detach();
        if ($request->input('user_id')) {
            $student->users()->attach($request->input('user_id'));
        }

        return redirect()->route('admin.student.index');
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
            return 'нет прав';
        }

        $student->users()->detach();
        $student->delete();
        return redirect()->route('admin.student.index');
    }
}
