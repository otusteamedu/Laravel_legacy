<?php

namespace App\Http\Controllers\Teachers;

use App\DTOs\TeacherFilterDTO;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Teachers\Requests\IndexTeacherRequest;
use App\Http\Controllers\Teachers\Requests\StoreTeacherRequest;
use App\Http\Controllers\Teachers\Requests\UpdateTeacherRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\EducationPlans\EducationPlanService;
use App\Services\Subjects\SubjectService;
use App\Services\Teachers\TeacherService;
use App\Services\Users\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /** @var TeacherService  */
    private $service;
    /** @var UserService  */
    private $userService;
    /** @var SubjectService  */
    private $subjectService;
    /** @var EducationPlanService  */
    private $educationPlanService;

    /**
     * TeacherController constructor.
     * @param TeacherService $service
     * @param UserService $userService
     * @param SubjectService $subjectService
     * @param EducationPlanService $educationPlanService
     */
    public function __construct(
        TeacherService $service,
        UserService $userService,
        SubjectService $subjectService,
        EducationPlanService $educationPlanService
    ) {
        parent::__construct();

        $this->service = $service;
        $this->userService = $userService;
        $this->subjectService = $subjectService;
        $this->educationPlanService = $educationPlanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexTeacherRequest $request
     * @return View
     */
    public function index(IndexTeacherRequest $request): View
    {
        $filterDTO = TeacherFilterDTO::fromArray($request->getFormData());

        return view('teachers.index', [
            'teachers' => $this->service->paginate($filterDTO),
            'titles' => $this->service->getTableTitles(),
            'subjectService' => $this->subjectService,
            'educationPlanService' => $this->educationPlanService,
            'subjects' => $this->subjectService->subjectSelectList(),
            'filter' => $filterDTO->toArray(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        Gate::authorize('create-teacher');
        $subjects = $this->subjectService->subjectSelectList();

        return view('teachers.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeacherRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        Gate::authorize('create-teacher');
        $userDTO = $this->userService->prepareUserDTOForRole($request->getFormData(), Role::TEACHER);

        $teacher = $this->userService->store($userDTO);

        if ($request->subject_id) {
            $subjectIdDTOCollection = $this->subjectService->getIdsFromArray($request->subject_id);
            $teacher = $this->service->syncWithSubjects($teacher, $subjectIdDTOCollection);
        }

        return redirect()->route('teachers.show', $teacher)
            ->with(['success' => __('messages.success_save')]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $teacher
     * @return View
     */
    public function show(User $teacher): View
    {
        $teacher->loadMissing([
            'subjects:id,name,user_id',
        ]);

        return view('teachers.view', [
            'teacher' => $teacher,
            'educationPlanService' => $this->educationPlanService,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $teacher
     * @return View
     */
    public function edit(User $teacher): View
    {
        Gate::authorize('update-teacher');

        return view('teachers.edit', [
            'teacher' => $teacher,
            'subjects' => $this->subjectService->subjectSelectList(),
            'teacherSubjectsId' => $this->service->getTeacherSubjectsId($teacher),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTeacherRequest $request
     * @param User $teacher
     * @return RedirectResponse
     */
    public function update(UpdateTeacherRequest $request, User $teacher): RedirectResponse
    {
        Gate::authorize('update-teacher');

        $userDTO = $this->userService->prepareUserDTOForRole($request->getFormData(), Role::STUDENT);
        $teacherUpdated = $this->userService->update($userDTO, $teacher);

        $subjectIdDTOCollection = $this->subjectService->getIdsFromArray($request->subject_id ?? []);
        $teacherUpdated = $this->service->syncWithSubjects($teacherUpdated, $subjectIdDTOCollection);

        return redirect()->route('teachers.show', $teacherUpdated)
            ->with(['success' => __('messages.success_update')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $teacher
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $teacher): RedirectResponse
    {
        Gate::authorize('delete-teacher');
        $this->userService->delete($teacher);

        return redirect()->route('teachers.index')
            ->with(['success' => __('messages.success_delete')]);
    }
}
