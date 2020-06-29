<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Policies\Abilities;
use Gate;
use Auth;
use Log;
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
        $this->getCurrentUser()->cant(Abilities::VIEW_ANY, Page::class);

        $this->authorize(Abilities::VIEW_ANY, Page::class);

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
        $this->authorize(Abilities::CREATE, Page::class);
        return view('admin.pages.create');
    }

    /**
     *
     * @param StorePageRequest $request
     * @return void
     */
    public function store(StorePageRequest $request)
    {
        $this->authorize(Abilities::CREATE, Page::class);
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
        $this->authorize(Abilities::UPDATE, $page);

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

        $this->authorize(Abilities::UPDATE, $page);

        $this->pagesService->updatePage($page, $request->all());

        $page->update($request->all());

        return redirect(route('cms.pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->authorize(Abilities::DELETE, $page);
        $page->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }

    /**
     * @return \App\Models\User|null
    */
    private function getCurrentUser()
    {
        return \Auth::user();
    }
}
