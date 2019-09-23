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
 * @property string|null $cover_file
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereCopyright($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereEpisodeNameTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereShownotesFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereCoverFile($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Episode[] $episodes
 * @property-read int|null $episodes_count
 * @property-read \App\Models\Episode $latestEpisode
 * @property int|null $category_itunes_id
 * @property-read \App\Models\CategoryItunes|null $categoryItunes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Podcast whereCategoryItunesId($value)
 */
class Podcast extends Model
{
    protected $fillable = [
        'name',
        'description',
        'author',
        'copyright',
        'keywords',
        'website',
        'shownotes_footer',
        'episode_name_template',
        'cover_file',
        'category_itunes_id',
    ];

    protected $casts = [
        'category_itunes_id' => 'integer',
    ];

    public function categoryItunes()
    {
        return $this->belongsTo(CategoryItunes::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    /**
     * https://softonsofa.com/tweaking-eloquent-relations-how-to-get-latest-related-model/
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latestEpisode()
    {
        return $this->hasOne(Episode::class)->latest('no');
    }

    public function coverUrl(): ?string
    {
        if (!$this->cover_file || !\Storage::exists($this->cover_file)) {
            return null;
        }
        return \Storage::url($this->cover_file);
    }
}
