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
    ) {
        $this->pagesService = $pagesService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->authorize(Abilities::VIEW_ANY, Page::class);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на просмотр страницы', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на просмотр страницы', []);
        }

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
        try {
            $this->authorize(Abilities::CREATE, Page::class);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на создание страницы', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на создание страницы', []);
        }
        return view('admin.pages.create');
    }

    /**
     *
     * @param StorePageRequest $request
     * @return void
     */
    public function store(StorePageRequest $request)
    {
        try {
            $this->authorize(Abilities::CREATE, Page::class);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на добавление страницы', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на добавление страницы', []);
        }

        $data = $request->getFormData();
        $this->pagesService->createPage($data);
        return redirect(route('cms.pages.index'));
    }


    /**
     *
     * @param Page $page
     * @return void
     */
    public function edit(Page $page)
    {
        try {
            $this->authorize(Abilities::UPDATE, $page);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на редактирование страницы', [
                $this->getCurrentUser(),

            ]);
            return  abort(403, 'Нет прав на редактирование страницы', []);
        }
        
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


        try {
            $this->authorize(Abilities::UPDATE, $page);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на обновление страницы', [
                $this->getCurrentUser(),
            ]);
            return  abort(403, 'Нет прав на редактирование/обновление страницы', []);
        }

        $this->pagesService->updatePage($page, $request->all());

        $page->update($request->all());

        return view('admin.pages.edit', [
            'page' => $page,
            'moderator'=>$this->getCurrentUser()->isModerator()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        try {
            $this->authorize(Abilities::DELETE, $page);
        } catch (AuthorizationException $e) {
            \Log::critical('Нет прав на удаление страницы', [
                $this->getCurrentUser(),
            ]);
            return abort(403, 'Нет прав на удаления страницы', []);
        }
        $page->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    /**
     * @return \App\Models\User|null
    */
    private function getCurrentUser()
    {
        return \Auth::user();
    }
}