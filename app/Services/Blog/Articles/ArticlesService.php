<?php


namespace App\Services\Blog\Articles;


class ArticlesService
{
    /** @var CountryRepositoryInterface */
    private $articleRepository;

    public function __construct(
        AuthorRepository $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }
}
