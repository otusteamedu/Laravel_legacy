<?php

namespace App\Models;

use App\Helpers\UrlHelpers;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Run
 *
 * @property int $id
 * @property string $url
 * @property int|null $project_id
 * @property int|null $repository_id
 * @property int|null $commit_id
 * @property int $worktime
 * @property int|null $user_id
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereCommitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereRepositoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereWorktime($value)
 * @mixin \Eloquent
 * @property-read mixed $href
 * @property-write mixed $raw
 * @property-read \App\Models\Commit|null $commit
 * @property-read \App\Models\Repository|null $repository
 * @property-read \App\Models\Project|null $project
 * @property string $error_phploc
 * @property string $error_phpinsights
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereErrorPhpinsights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Run whereErrorPhploc($value)
 */
class Run extends Model
{
    protected $fillable = [
        'project_id',
        'repository_id',
        'commit_id',
        'worktime',
        'url',
        'ip',
        'user_id',
        'error_phploc',
        'error_phpinsights',
    ];

    protected $casts = [
        'project_id' => 'integer',
        'repository_id' => 'integer',
        'commit_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function commit()
    {
        return $this->belongsTo(Commit::class);
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getHrefAttribute(): ?string
    {
        return UrlHelpers::getHref($this->url);
    }
}
