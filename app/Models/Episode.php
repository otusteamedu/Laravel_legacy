<?php

namespace App\Models;

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

    public function coverUrl(): ?string
    {
        if (!$this->cover_file || !\Storage::exists($this->cover_file)) {
            // Если для самого эпизода обложка не загружена, попробуем взять обложку из подкаста
            return $this->podcast ? $this->podcast->coverUrl() : null;
        }
        return \Storage::url($this->cover_file);
    }
}
