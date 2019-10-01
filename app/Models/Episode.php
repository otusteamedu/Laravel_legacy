<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Episode
 *
 * @property int $id
 * @property string $name
 * @property int $season
 * @property int $no
 * @property string $show_notes
 * @property int $podcast_id
 * @property string|null $cover_file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Podcast $podcast
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode wherePodcastId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode whereShowNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereCoverFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Episode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Episode extends Model
{
    protected $fillable = [
        'name',
        'season',
        'no',
        'show_notes',
        'podcast_id',
        'cover_file',
    ];

    protected $casts = [
        'season' => 'integer',
        'no' => 'integer',
        'podcast_id' => 'integer',
    ];

    /**
     * Подкаст всегда загружаем вместе с эпизодом, т.к. практически на всех экранах где выводится эпизод
     * требуется информация и о подкасте
     * @var array
     */
    protected $with = ['podcast'];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }

    public function users()
    {
        // Как проверить с помощью tinker:
        // $episode = Episode::find(/*какой-нибудь id*/);
        // $episode->users()->toSql()
        // select * from `users` inner join `podcast_user` on `users`.`id` = `podcast_user`.`user_id` where `podcast_user`.`podcast_id` = ?
        return $this->belongsToMany(User::class, 'podcast_user', 'podcast_id', 'user_id', 'podcast_id');
    }

    public function coverUrl(): ?string
    {
        if (!$this->cover_file || !\Storage::exists($this->cover_file)) {
            // Если для самого эпизода обложка не загружена, попробуем взять обложку из подкаста
            return $this->podcast ? $this->podcast->coverUrl() : null;
        }
        return \Storage::url($this->cover_file);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, User $user)
    {
        // "select * from `episodes` where exists (select * from `users` inner join `podcast_user` on `users`.`id` = `podcast_user`.`user_id` where `episodes`.`podcast_id` = `podcast_user`.`podcast_id` and `user_id` = ?)"
        return $query->whereHas('users', function ($q) use ($user) {
            $q->where('user_id', '=', $user->id);
        });
    }

    /**
     * Определяет, относится ли данный эпизод к указанному пользователю?
     * @param User $user
     * @return bool
     */
    public function hasUser(User $user): bool
    {
        return $this->podcast->hasUser($user);
    }
}
