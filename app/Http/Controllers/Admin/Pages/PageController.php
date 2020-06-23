<?php

namespace App\Http\Controllers\Admin\Pages;

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Admin\Pages\Requests\StorePageRequest;
use App\Http\Controllers\Admin\Pages\Requests\UpdatePageRequest;
use App\Models\Page;
use App\Services\Pages\PagesService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use View;

class PageController extends Controller
{


    protected $pagesService;

    public function __construct(
        PagesService $pagesService
    )
    {
       $this->pagesService = $pagesService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        View::share([
            'pages' => Page::paginate(),
        ]);
        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     *
     * @param StorePageRequest $request
     * @return void
     */
    public function store(StorePageRequest $request)
    {
        $data = $request->getFormData();
        $this->pagesService->createPage($data);
        return redirect(route('cms.pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     *
     * @param Page $page
     * @return void
     */
    public function edit(Page $page)
    {
        //
        return view('admin.pages.edit', [
            'page' => $page,
        ]);

    }

    /**
     *
     * @param UpdatePageRequest $request
     * @param Page $page
     * @return void
     */
    public function update(UpdatePageRequest $request, Page $page)
    {

        $this->filmsService->updatePage($page, $request->all());

        $page->update($request->all());

        return redirect(route('cms.films.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
