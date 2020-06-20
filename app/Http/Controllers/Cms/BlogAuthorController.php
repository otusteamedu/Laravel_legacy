<?php
namespace App\Http\Controllers\Cms;


use App\Http\Controllers\Controller;
use App\Models\Blog\BlogAuthor;
use App\Models\File;
use App\Services\File\FileData;
use App\Services\File\FileService;
use View;
use Illuminate\Http\Request;
use App\Services\Blog\Author\AuthorService;
use App\Http\Controllers\Cms\Requests\StoreAuthorRequest;

class BlogAuthorController extends Controller
{
    /**
     * @var AuthorService
     */
    protected $blogAuthorService;

    /**
     * @var FileService
     */
    protected $fileService;

    public function __construct(
        AuthorService $blogAuthorService,
        FileService $fileService
    )
    {
        $this->blogAuthorService = $blogAuthorService;
        $this->fileService = $fileService;
    }

    public function index()
    {
        View::share(Array(
            'authors' => BlogAuthor::paginate(10)
        ));

        return view('cms.blog.author.index');
    }

    public function create()
    {
        return view('cms.blog.author.create');
    }

    public function edit(BlogAuthor $author)
    {
        View::share(Array(
            'author' => $author,
        ));

        return view('cms.blog.author.edit');
    }

    public function store(StoreAuthorRequest $request)
    {
        $this->blogAuthorService->storeAuthor($request);

        return redirect(route('cms.blog.authors'));
    }

    public function delete(BlogAuthor $author)
    {
        $this->blogAuthorService->deleteAuthor($author);

        return redirect(route('cms.blog.authors'));
    }
}
