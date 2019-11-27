<?php


namespace App\Http\Controllers\Publica;


use App\Base\Service\CD;
use App\Http\Controllers\Controller;
use App\Services\FileService;
use App\Services\Interfaces\IMovieService;
use App\Services\ResizeService;

class StartController extends Controller
{
    /**
     * @var IMovieService
     */
    private $movieService;
    /**
     * @var ResizeService
     */
    private $resizeService;
    /**
     * @var FileService
     */
    private $fileService;

    /**
     * StartController constructor.
     * @param IMovieService $movieService
     * @param ResizeService $resizeService
     * @param FileService $fileService
     */
    public function __construct(
        IMovieService $movieService,
        ResizeService $resizeService,
        FileService $fileService)
    {
        $this->movieService = $movieService;
        $this->fileService = $fileService;
        $this->resizeService = $resizeService;
    }

    public function index()
    {
        $fs = $this->fileService;
        $rs = $this->resizeService;

        $premierMovies = $this->movieService->getSoonInRentalCached(4, new CD('top_premier', 3600*24, ['top_premier', 'all_movies']));
        array_walk($premierMovies, function (&$movie) use ($fs) {
            /** @var FileService $fs */
            $movie['poster'] = $fs->getLocalFileArray($movie['poster']);
            $movie['poster_url'] = $movie['poster'] ? $fs->getAssetFile($movie['poster']) : null;
        });

        $showingMovies = $this->movieService->getInRentalRandCached(6, new CD('rand_showing', 3600*12, ['rand_premier', 'all_movies']));
        array_walk($showingMovies, function (&$movie) use ($fs, $rs) {
            $movie['poster'] = $fs->getLocalFileArray($movie['poster']);
            $movie['poster_thumb'] = $movie['poster'] ? $rs->ResizeImage($movie['poster'], [
                'type' => ResizeService::RESIZE_CROPPING,
                'width' => 360,
                'height' => 215
            ]) : null;

            $movie['poster_thumb_url'] = $movie['poster_thumb'] ? $fs->getAssetFile($movie['poster_thumb']) : null;
        });

        return view('public.start.index', compact('premierMovies','showingMovies'));
    }
}
