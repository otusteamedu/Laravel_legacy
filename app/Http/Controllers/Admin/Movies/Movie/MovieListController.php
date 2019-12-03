<?php

namespace App\Http\Controllers\Admin\Movies\Movie;

use App\Base\Controller\AbstractListController;
use App\Base\Controller\HtmlFilter\Filter;
use App\Base\Service\Q;
use App\Models\Movie;
use App\Services\FileService;
use App\Services\Interfaces\IMovieService;
use App\Services\ResizeService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class MovieListController extends AbstractListController
{
    protected $movieService;

    public function __construct(
        IMovieService $movieService)
    {
        parent::__construct();
        $this->movieService = $movieService;
    }

    public function prepareAction($method, $parameters): void {
        parent::prepareAction($method, $parameters);
        // формировать формировать список нужно тут
        $this->filter = (new Filter($this->request))
            ->add('text', 'name', ['choose_match' => true])
                ->title(__('admin.title'))
                ->default(['text' => '', 'exact' => true])
                ->filter()
            ->init();

        $query = new Q($this->filter->getData(), [$this->sort => $this->by], $this->nav);
        $this->data = $this->movieService->paginateByFilter($query);
        $this->nav = $query->getNav();

        /** @var Movie $item */
        //foreach ($this->data as $item) {
        //    if($item->poster)
        //        $file = $this->fileService->getLocalFile($item->poster);
            // dd($request);
        //}
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('view', Movie::class);

        return view('admin.movies.index', [
            'filterHtml' => $this->filter->render(),
            'navHtml' => $this->nav['html'],
            'movies' => $this->data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $itemId
     * @return \Illuminate\Routing\Redirector
     * @throws AuthorizationException
     */
    public function destroy(int $itemId): Redirector
    {
        /** @var Movie $movie */
        $movie = $this->movieService->findModel($itemId);

        $this->authorize('delete', $movie);

        $this->movieService->remove($movie);

        $this->status(__('success.movies.deleted', ['name' => $movie->name]));

        return redirect(route('admin.movies.index'));
    }
}
