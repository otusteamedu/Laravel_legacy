<?php

namespace App\Services;

use App\Models\ArticleState;
use App\Services\Repositories\ArticleCacheRepository;
use App\Services\Repositories\ArticleRepository;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ArticlesService
 * @package App\Services
 */
class ArticlesService
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var ArticleCacheRepository
     */
    private $articleCacheRepository;

    /**
     * ArticlesService constructor.
     * @param ArticleRepository $articleRepository
     * @param ArticleCacheRepository $articleCacheRepository
     */
    public function __construct(ArticleRepository $articleRepository, ArticleCacheRepository $articleCacheRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->articleCacheRepository = $articleCacheRepository;
    }

    /**
     * @param array|null $options
     * @return Article[]|Collection
     */
    public function all(array $options = null)
    {
        return $this->articleRepository->getAll($options);
    }

    /**
     * @param array|null $options
     * @param $resourceCacheKey
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allPaginated(array $options = null, $resourceCacheKey)
    {
        return $this->articleCacheRepository->paginated($options, $resourceCacheKey);
    }

    /**
     * @param array $options
     */
    public function allPaginatedBy(array $options)
    {
        $articles = $this->articleCacheRepository->findBy($options['criterias'], $options['limit'], $options['page']);
        return $articles;
    }

    /**
     * @param array $data
     * @return Article
     */
    public function createArticle(array $data)
    {
        $data['state_id'] = ArticleState::STATE_DRAFT;
        $data['image'] = '/img/image.jpg';

        return $this->articleRepository->createFromArray($data);
    }

    /**
     * @param Article $article
     * @param array $data
     * @return Article
     */
    public function updateArticle(Article $article, array $data)
    {
        return $this->articleRepository->updateFromArray($article, $data);
    }

    /**
     * @param Article $article
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function deleteArticle(Article $article, array $options = null)
    {
        return $this->articleRepository->delete($article);
    }


    /*
     * Получение статей ожидающих публикации
     *
     * @return Article[]|Collection|null
     */
    public function getPendingItems()
    {
        return $this->articleRepository->findBy(['is_pending' => 1, 'state_id' => ArticleState::STATE_WAITING_PUBLICATION]);
    }

    /**
     * @param Article $article
     * @param boolean $prePublication
     * @return boolean
     */
    public function publishArticle(Article $article, bool $prePublication)
    {
        $article->state_id = ArticleState::STATE_PUBLISHED;
        $article->is_prepublish = $prePublication;

        return $article->save();
    }

    /**
     * Очистка кэша
     */
    public function clearCache()
    {
        $this->articleCacheRepository->clear();

    }

    public function prepareForPublication(Article $article)
    {
        $thumb = $this->createThumbnail($article->image);
        $article->image_intro = $thumb;
        //...
    }

    /**
     * Создание миниатюры изображения
     *
     * @param string $source
     * @return string
     */
    function createThumbnail(string $source)
    {
        $nw = 150;    // Ширина миниатюр
        $nh = 100;    // Высота миниатюр
        $source = public_path($source);
        $basename = basename($source);
        $dest = public_path("img/articles/thumb/{$basename}");   // Файл с результатом работы

        $stype = explode(".", $source);
        $stype = $stype[count($stype) - 1];

        $size = getimagesize($source);
        $w = $size[0];    // Ширина изображения
        $h = $size[1];    // Высота изображения

        switch ($stype) {
            case 'gif':
                $simg = imagecreatefromgif($source);
                break;
            case 'jpg':
                $simg = imagecreatefromjpeg($source);
                break;
            case 'png':
                $simg = imagecreatefrompng($source);
                break;
        }

        $dimg = imagecreatetruecolor($nw, $nh);
        $wm = $w / $nw;
        $hm = $h / $nh;
        $h_height = $nh / 2;
        $w_height = $nw / 2;

        if ($w > $h) {
            $adjusted_width = $w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h);
        } elseif (($w < $h) || ($w == $h)) {
            $adjusted_height = $h / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
            imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h);
        } else {
            imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
        }
        imagejpeg($dimg, $dest, 100);

        return $dest;
    }

}
