<?php

use App\Model\Article\Article;
use App\Model\Article\Tag;
use App\Model\User\Role;
use App\Model\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class ArticleSeeder
 *
 * Заполняет таблицу статей
 */
class ArticleSeeder extends Seeder
{
    /** @var Tag[]|Collection|null список тегов */
    private $tags;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $authorList = $this->getAuthors();

        $articleList = new Collection();
        foreach ($authorList as $author) {
            $list = factory(Article::class, random_int(1, 4))->create(['user_id' => $author->id]);
            $articleList = $articleList->merge($list);
        }

        $this->attachTags($articleList);
    }

    /**
     * Добавляет теги к статьям
     * @param Article[]|Collection $articleList
     * @throws Exception
     */
    private function attachTags(Collection $articleList): void
    {
        foreach ($articleList as $article) {
            $tagList = $this->getTags()->random(random_int(0, 3));
            foreach ($tagList as $tag) {
                $article->tags()->attach($tag->id);
            }
        }
    }

    /**
     * Возвращает список тегов
     * @return Tag[]|Collection
     */
    private function getTags(): Collection
    {
        if ($this->tags !== null) {
            return $this->tags;
        }

        $this->tags = Tag::all();
        return $this->tags;
    }

    /**
     * Возвращает авторскую роль
     * @return Role|Builder|Model
     */
    private function getAuthorRole(): Role
    {
        return Role::query()
            ->where('code', 'author')
            ->with('users')
            ->firstOrFail();
    }

    /**
     * Возвращает авторов
     * @return User[]|Collection
     */
    private function getAuthors(): Collection
    {
        return $this->getAuthorRole()->users;
    }
}
