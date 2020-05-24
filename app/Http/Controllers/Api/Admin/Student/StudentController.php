<?php

namespace App\Http\Controllers\Api\Admin\Student;

use App\Http\Controllers\Api\Admin\Student\Resources\StudentResources;
use App\Http\Controllers\Api\Admin\Student\Resources\StudentsResources;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    protected $studentService;

    public function __construct(
        StudentService $studentService
    )
    {
        $this->studentService = $studentService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//list
    {
        $students = $this->studentService->all();
        return response()->json(new StudentsResources($students));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
FindByEmail()
getAllByAge()
updateEmail()
updateFullName()
    public function store(Request $request)
    {

        $data = $request->all();
        $insert = $this->studentService->store($data);
        return response()->json(new StudentResources($insert));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return response()->json(new studentResources($student));
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
        try {

            $this->studentService->update($student, $request->all());
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'No'], 200
            );
        }
        return response()->json(new StudentResources($student));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
