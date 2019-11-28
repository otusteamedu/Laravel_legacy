<?php

namespace App\Http\Controllers\Admin\Movies\Movie;

use App\Base\Controller\AbstractListController;
use App\Base\Controller\HtmlFilter\Filter;
use App\Models\Movie;
use App\Services\FileService;
use App\Services\Interfaces\IMovieService;
use App\Services\ResizeService;

class MovieListController extends AbstractListController
{
    protected $movieService;
    protected $fileService;
    protected $resizeService;

    public function __construct(
        IMovieService $movieService,
        FileService $fileService,
        ResizeService $resizeService)
    {
        parent::__construct();

        $this->movieService = $movieService;
        $this->fileService = $fileService;
        $this->resizeService = $resizeService;
    }

    public function prepareAction($method, $parameters): void {
        // формировать формировать список нужно тут
        $this->filter = (new Filter($this->request))
            ->add('text', 'name', ['choose_match' => true])
                ->title(__('admin.title'))
                ->default(['text' => '', 'exact' => true])
                ->filter()
            ->init();

        $this->data = $this->movieService->paginateByFilter(
            $this->filter->getData(),
            [$this->sort => $this->by],
            $this->nav
        );

        /** @var Movie $item */
        foreach ($this->data as $item) {
            if($item->poster)
                $file = $this->fileService->getLocalFile($item->poster);
            // dd($request);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', Movie::class);
        //$this->movieRepository->getNamespace();
        //exit;
        //
        return view('admin.movies.index', [
            'filterHtml' => $this->filter->render(),
            'movies' => $this->data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $itemId
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(int $itemId)
    {
        /** @var Movie $movie */
        $movie = $this->movieService->findModel($itemId);

        $this->authorize('delete', $movie);

        $this->movieService->remove($itemId);

        $this->status(__('success.movies.deleted', ['name' => $movie->name]));

        return redirect(route('admin.movies.index'));
    }
}
