<?php

namespace App\Models;

use App\Services\Events\Models\Film\FilmSaved;
use App\Services\Events\Models\Film\FilmUpdated;

/**
 * App\Models\Film
 *
 *
 * @OA\Schema(
 *  @OA\Xml(name="Film"),
 *  @OA\Property(property="title", type="string",  example="Witcher 3"),
 *  @OA\Property(property="meta_title", type="string",  description="title for search",  example="Witсher 3 watch online"),
 *  @OA\Property(property="meta_description", type="string", description="description for search", example="Witсher 3 most..."),
 *  @OA\Property(property="keywords", type="string", description="keywords for search", example="witсher 3,witсher 3 online"),
 *  @OA\Property(property="slug", type="string", description="name film slug", example="witcher_3"),
 *  @OA\Property(property="status", type="string", description="Status Film 0 or 1", example="0"),
 *  @OA\Property(property="content", type="string", description="Content Film", example="Full content filn"),
 *  @OA\Property(property="year", type="string", description="Year of film", example="2005"),
 *  @OA\Property(property="image", type="string", description="Image for film", example=""),
 *  @OA\Property(property="created_at", readOnly=true, type="string",  format="date-time", description="Datetime marker of verification status", example="2019-02-25 12:59:20"),
 *  @OA\Property(property="updated_at", readOnly=true, type="string",  format="date-time", description="Datetime marker of verification status", example="2019-02-25 12:59:20"),

 * )
 *
 * @property int $id
 * @property string $title Название фильма
 * @property string|null $meta_title Название фильма для поисковой системы
 * @property string $meta_description Описание для поисковой системы
 * @property string $keywords Ключевые слова для поисковой системы
 * @property string $slug Название фильма транслитом для ЧПУ
 * @property string $status Опубликовано или нет
 * @property string $content Описание фильма
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


    const STATUS_PUBLISHED = 1;
    const STATUS_NOT_PUBLISHED = 0;
    const STATE_WAITING_PUBLICATION = 2;

    protected $dispatchesEvents = [
        'saved' => FilmSaved::class,
        'updated'=> FilmUpdated::class,
    ];

    protected $fillable = [
        'title',
        'meta_title',
        'meta_description',
        'keywords',
        'slug',
        'status',
        'content',
        'year',
        'image'
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
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
        return $this->belongsToMany(ActorAndRole::class);
    }
}
