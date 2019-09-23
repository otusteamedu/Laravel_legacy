<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Podcast
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @property string $description
 * @property string $author
 * @property string $copyright
 * @property string $keywords
 * @property string $website
 * @property string $shownotes_footer
 * @property string $episode_name_template
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereCopyright($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereEpisodeNameTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereShownotesFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereWebsite($value)
 */
class Podcast extends Model
{
    protected $fillable = [
        'name',
        'description',
        'author',
        'copyright',
        'category',
        'keywords',
        'website',
        'shownotes_footer',
        'episode_name_template',
    ];
}
