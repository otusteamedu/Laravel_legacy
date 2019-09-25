<?php

namespace App\Http\Controllers\Admin\Movies;

use App\Models\Person;
use App\Repositories\People\IPersonRepository;
use App\Services\FileService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    protected $personRepository;
    protected $fileService;

    public function __construct(
        IPersonRepository $personRepository,
        FileService $fileService
    ) {
        $this->personRepository = $personRepository;
        $this->fileService = $fileService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('admin.people.index', [
            'dataList' => $this->personRepository->search()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('admin.people.create', ['dataItem' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $person = $this->personRepository->createFromArray($request->all());
        $file = $request->file('photo');
        if($file) {
            $photo = $this->fileService->saveFile($file);
            $person->photo()->associate($photo);
            $person->save();
        }

        return redirect(route('admin.people.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Person $person
     * @return Response
     */
    public function edit(Person $person)
    {
        //
        return view('admin.people.edit', ['dataItem' => $person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Person $person
     * @return void
     * @throws \Exception
     */
    public function update(Request $request, Person $person)
    {
        //
        $person = $this->personRepository->updateFromArray($person, $request->all());
        $file = $request->file('photo');
        if($request->has('photo_delete')) {
            $photo = $person->photo()->dissociate();
            $this->fileService->removeFile($photo);

            $person->save();
        }
        if($file) {
            $photo = $this->fileService->replaceFile($file, $person->photo);
            $person->photo()->associate($photo);
            $person->save();
        }

        return redirect(route('admin.people.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Person $person
     * @return Response
     * @throws \Exception
     */
    public function destroy(Person $person)
    {
        //
        if($person->photo) {
            $photo = $person->photo()->dissociate();
            $this->fileService->removeFile($photo);
        }
        $this->personRepository->remove($person);
        return redirect(route('admin.people.index'));
    }
}
