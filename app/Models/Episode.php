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
    ];

    protected $casts = [
        'season' => 'integer',
        'no' => 'integer',
        'podcast_id' => 'integer',
    ];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
