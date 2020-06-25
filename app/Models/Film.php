<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



/**
 * App\Models\Film
 *
 * @property int $id
 * @property string $title Название фильма
 * @property string|null $meta_title Название фильма для поисковой системы
 * @property string $meta_description Описание для поисковой системы
 * @property string $keywords Ключевые слова для поисковой системы
 * @property string $slug Название фильма транслитом для ЧПУ
 * @property string $status Опубликовано или нет
 * @property string $content Описание фильма
 * @property string|null $role Роль актера в данном фильме
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Actor[] $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Producer[] $producers
 * @property-read int|null $producers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Year[] $years
 * @property-read int|null $years_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $year Год фильма
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ActorAndRole[] $actorsAndRoles
 * @property-read int|null $actors_and_roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Film whereYear($value)
 */
class Film extends Model
{
   /**
   * The table associated with the model.
   *
   * @var string
   */
   protected $table = 'films';

    protected $fillable = [
        'title',
        'meta_title',
        'meta_description',
        'keywords',
        'slug',
        'status',
        'content',
        'year'
    ];

   public function actors()
   {
      return $this->hasMany(Actor::class);
   }

   public function genres()
   {
      return $this->hasMany(Genre::class);

   }

   public function producers()
   {
      return $this->hasMany(Producer::class);
   }

   public function years()
   {
      return $this->hasMany(Year::class);
   }

   public function comments()
   {
      return $this->hasMany(Comment::class);
   }

   public function actorsAndRoles()
   {
      return $this->hasMany(ActorAndRole::class);
   }

}
