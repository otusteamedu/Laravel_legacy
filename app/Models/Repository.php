<?php

namespace App\Models;

use App\ValueObjects\RepositoryUrl;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Repository
 *
 * @property int $id
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repository query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repository whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repository whereUrl($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Commit[] $commits
 * @property-read int|null $commits_count
 * @property-write mixed $raw
 * @property string $normalized_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Repository whereNormalizedUrl($value)
 */
class Repository extends Model
{
    protected $fillable = [
        'url',
        'normalized_url',
    ];

    public function commits()
    {
        return $this->hasMany(Commit::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
