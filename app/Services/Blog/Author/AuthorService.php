<?php


namespace App\Services\Blog\Author;


use App\Http\Controllers\Proxy\Requests\StoreProxyRequest;
use App\Models\Blog\BlogAuthor;
use App\Services\Blog\Author\Handlers\CreateAuthorHandler;
use App\Services\Blog\Author\Handlers\UpdateAuthorHandler;
use App\Services\Blog\Author\Handlers\DeleteAuthorHandler;

class AuthorService
{
    /**
     * @var UpdateAuthorHandler
     */
    private $updateAuthorHandler;

    /**
     * @var CreateAuthorHandler
     */
    private $createAuthorHandler;

    /**
     * @var DeleteAuthorHandler
     */
    private $deleteAuthorHandler;

    public function __construct(
        CreateAuthorHandler $createAuthorHandler,
        UpdateAuthorHandler $updateAuthorHandler,
        DeleteAuthorHandler $deleteAuthorHandler
    )
    {
        $this->createAuthorHandler = $createAuthorHandler;
        $this->updateAuthorHandler = $updateAuthorHandler;
        $this->deleteAuthorHandler = $deleteAuthorHandler;
    }

    public function createAuthor(array $data): BlogAuthor
    {
        return $this->createAuthorHandler->handle($data);
    }

    public function updateAuthor($id, array $data): BlogAuthor
    {
        return $this->updateAuthorHandler->handle($id, $data);
    }

    public function deleteAuthor(BlogAuthor $blogAuthor)
    {
        return $this->deleteAuthorHandler->handle($blogAuthor);
    }

    public function storeAuthor(StoreProxyRequest $request)
    {
        $validated = $request->validated();

        $id = $request->get('id');

        if(intval($id) > 0) {
            $this->updateAuthor(BlogAuthor::find($id), $request->toArray());
        } else {
            $this->createAuthor($request->toArray());
        }
    }
}
