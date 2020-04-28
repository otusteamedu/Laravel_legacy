<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\User;

use App\Services\User\UserService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    protected $userService;

//    public function __construct(
//        UserService $userService
//    )
//    {
//        $this->userService = $userService;
//    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.index', [
            'students' => Student::orderBy('id', 'desc')->paginate(10)
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
            'users' => User::all(),
//            'users' => $this->userService->all(),
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

        $student = Student::create($request->except('user_id'));
        if ($request->input('user_id')):
            $student->users()->attach($request->input('user_id'));
        endif;


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
        return view('student.edit', [
            'student' => $student,
            'users' => User::all(),
//          'users' => $this->userService->all(),
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
        $student->users()->detach();
        $student->delete();
        return redirect()->route('admin.student.index');
    }
}
