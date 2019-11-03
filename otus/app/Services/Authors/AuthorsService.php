<?php

namespace App\Services\Authors;

use App\Models\Author;
use App\Services\Authors\Repositories\AuthorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorsService {

    private $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository) {
        $this->authorRepository = $authorRepository;
    }

    public function findAuthor(int $id): Author {
        return $this->authorRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchAuthors(): LengthAwarePaginator {
        return $this->authorRepository->search();
    }

    /**
     * @param array $data
     * @return Author
     */
    public function storeAuthor(array $data) : Author {
        return $this->authorRepository->createFromArray($data);
    }

    /**
     * @param Author $author
     * @param array $data
     */
    public function updateAuthor(Author $author, array $data) {
        $this->authorRepository->updateFromArray($author, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyAuthors(array $ids) {
       $this->authorRepository->destroy($ids);
    }
}
