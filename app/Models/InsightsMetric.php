<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InsightsMetric
 *
 * @property int $id
 * @property int|null $project_id
 * @property int $repository_id
 * @property int $commit_id
 * @property float $code
 * @property float $complexity
 * @property float $architecture
 * @property float $style
 * @property int $security_issues
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Commit $commit
 * @property-read \App\Models\Project|null $project
 * @property-read \App\Models\Repository $repository
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereArchitecture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereCommitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereComplexity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereRepositoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereSecurityIssues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InsightsMetric forProject(\App\Models\Project $project)
 */
class InsightsMetric extends Model
{
    protected $fillable = [
        'project_id',
        'repository_id',
        'commit_id',
        'code',
        'complexity',
        'architecture',
        'style',
        'security_issues',
    ];

    protected $casts = [
        'project_id' => 'integer',
        'repository_id' => 'integer',
        'commit_id' => 'integer',
        'code' => 'float',
        'complexity' => 'float',
        'architecture' => 'float',
        'style' => 'float',
        'security_issues' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function commit()
    {
        return $this->belongsTo(Commit::class);
    }

    public function scopeForProject($query, Project $project)
    {
        return $query->where([
            'project_id' => $project->id,
            'repository_id' => $project->repository_id,
        ]);
    }
}
