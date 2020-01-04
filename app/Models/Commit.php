<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Commit
 *
 * @property int $id
 * @property string $hash
 * @property int $repository_id
 * @property string $author
 * @property \Illuminate\Support\Carbon $commit_datetime
 * @property string $summary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit whereCommitDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit whereRepositoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Repository $repository
 * @property-write mixed $raw
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InsightsMetric[] $insightsMetrics
 * @property-read int|null $insights_metrics_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LocMetric[] $locMetrics
 * @property-read int|null $loc_metrics_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Commit forProject(\App\Models\Project $project)
 */
class Commit extends Model
{
    protected $fillable = [
        'hash',
        'author',
        'commit_datetime',
        'summary',
        'repository_id',
    ];

    protected $casts = [
        'commit_datetime' => 'datetime',
        'repository_id' => 'integer',
    ];

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function locMetrics()
    {
        return $this->hasMany(LocMetric::class);
    }

    public function insightsMetrics()
    {
        return $this->hasMany(InsightsMetric::class);
    }

    public function scopeForProject($query, Project $project)
    {
        return $query->where([
            'repository_id' => $project->repository_id,
        ])->with([
            'locMetrics' => function ($query) use ($project) {
                /** @var \App\Models\LocMetric $query */
                $query->forProject($project)->orderBy('id', 'desc');
            },
            'insightsMetrics' => function ($query) use ($project) {
                /** @var \App\Models\InsightsMetric $query */
                $query->forProject($project)->orderBy('id', 'desc');
            },
        ]);
    }
}
