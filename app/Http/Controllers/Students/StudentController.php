<?php

namespace App\Http\Controllers\Students;

use App\DTOs\IdDTO;
use App\DTOs\StudentDTO;
use App\DTOs\StudentFilterDTO;
use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Students\Requests\IndexStudentRequest;
use App\Http\Controllers\Students\Requests\StoreStudentRequest;
use App\Http\Controllers\Students\Requests\UpdateStudentRequest;
use App\Models\Role;
use App\Models\Student;
use App\Services\Courses\CourseService;
use App\Services\Groups\GroupService;
use App\Services\Students\StudentService;
use App\Services\Users\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    /** @var StudentService  */
    private $service;
    /** @var UserService  */
    private $userService;
    /** @var GroupService  */
    private $groupService;
    /** @var CourseService  */
    private $courseService;

    /**
     * StudentController constructor.
     * @param StudentService $service
     * @param UserService $userService
     * @param GroupService $groupService
     * @param CourseService $courseService
     */
    public function __construct(
        StudentService $service,
        UserService $userService,
        GroupService $groupService,
        CourseService $courseService
    ) {
        parent::__construct();

        $this->service = $service;
        $this->userService = $userService;
        $this->groupService = $groupService;
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexStudentRequest $request
     * @return View
     */
    public function index(IndexStudentRequest $request): View
    {
        $DTO = StudentFilterDTO::fromArray($request->getFormData());
        $students = $this->service->paginate($DTO);
        $titles = $this->service->getTableTitles();
        $filter = $DTO->toArray();
        $courseList = $this->courseService->courseSelectList();
        $groupList = $this->groupService->groupSelectList();

        $groupService = $this->groupService;
        $courseService = $this->courseService;

        return view('students.index', compact(
            'students',
            'titles',
            'filter',
            'groupService',
            'courseService',
            'courseList',
            'groupList'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $courseList = $this->courseService->courseSelectList();
        $groupList = $this->groupService->selectListWithCourse();

        return view('students.create', compact('courseList', 'groupList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $userDTO = $this->userService->prepareUserDTOForStudent($request->getFormData());
        $groupIdDTOCollection = $this->groupService->getIdsFromArray($request->group_id);

        $user = $this->userService->store($userDTO);
        $userIdDTO = IdDTO::fromArray([IdDTO::ID => $user->id]);
        $student = $this->service->store($request, $userIdDTO, $groupIdDTOCollection);

        return redirect()->route('students.show', $student->id)
            ->with(['success' => __('messages.success_save')]);
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return View
     */
    public function show(Student $student): View
    {
        $student->loadMissing([
            'user:id,last_name,name,second_name',
            'groups:id,number,course_id',
            'groups.course:id,number'
        ]);

        return view('students.view', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return View
     */
    public function edit(Student $student): View
    {
        $courseList = $this->courseService->courseSelectList();
        $groupList = $this->groupService->selectListWithCourse();
        $studentGroupsId = $this->service->getStudentGroupsId($student);

        return view('students.edit', compact('student', 'courseList', 'groupList', 'studentGroupsId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $userDTO = $this->userService->prepareUserDTOForStudent($request->getFormData());
        $groupIdDTOCollection = $this->groupService->getIdsFromArray($request->group_id);

        $user = $this->userService->update($userDTO, $student->user);
        $studentDTO = StudentDTO::fromArray(array_merge(
            $request->getFormData(),
            [StudentDTO::USER_ID => $user->id]
        ));
        $studentUpdated = $this->service->update($studentDTO, $student, $groupIdDTOCollection);

        return redirect()->route('students.show', $studentUpdated)
            ->with(['success' => __('messages.success_update')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return RedirectResponse
     */
    public function destroy(Student $student): RedirectResponse
    {
        $this->service->delete($student);

        return redirect()->route('students.index')
            ->with(['success' => __('messages.success_delete')]);
    }
}
