<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LocMetric
 *
 * @property int $id
 * @property int $commit_id
 * @property int $directories Directories
 * @property int $files Files
 * @property int $loc Lines of Code (LOC)
 * @property int $lloc Logical Lines of Code (LLOC)
 * @property int $lloc_classes Classes Length (LLOC)
 * @property int $lloc_functions Functions Length (LLOC)
 * @property int $lloc_global LLOC outside functions or classes
 * @property int $cloc Comment Lines of Code (CLOC)
 * @property int $ccn
 * @property int $ccn_methods
 * @property int $interfaces Interfaces
 * @property int $traits Traits
 * @property int $classes Classes
 * @property int $abstract_classes Abstract Classes
 * @property int $concrete_classes Concrete Classes
 * @property int $functions Functions
 * @property int $named_functions Named Functions
 * @property int $anonymous_functions Anonymous Functions
 * @property int $methods Methods
 * @property int $public_methods Public Methods
 * @property int $non_public_methods Non-Public Methods
 * @property int $non_static_methods Non-Static Methods
 * @property int $static_methods Static Methods
 * @property int $constants Constants
 * @property int $class_constants Class Constants
 * @property int $global_constants Global Constants
 * @property int $test_classes Test Classes
 * @property int $test_methods Test Methods
 * @property float $ccn_by_lloc Average Complexity per LLOC
 * @property float $lloc_by_nof Average Function Length (LLOC)
 * @property int $method_calls Method Calls
 * @property int $static_method_calls Static Method Calls
 * @property int $instance_method_calls Non-Static Method Calls
 * @property int $attribute_accesses Attribute Accesses
 * @property int $static_attribute_accesses Static Attribute Accesses
 * @property int $instance_attribute_accesses Non-Static Attribute Accesses
 * @property int $global_accesses Global Accesses
 * @property int $global_variable_accesses Global Variable Accesses
 * @property int $super_global_variable_accesses Super-Global Variable Accesses
 * @property int $global_constant_accesses Global Constant Accesses
 * @property int $class_ccn_min Minimum Class Complexity
 * @property float $class_ccn_avg Average Complexity per Class
 * @property int $class_ccn_max Maximum Class Complexity
 * @property int $class_lloc_min Minimum Class Length
 * @property float $class_lloc_avg Average Class Length
 * @property int $class_lloc_max Maximum Class Length
 * @property int $method_ccn_min Minimum Method Complexity
 * @property float $method_ccn_avg Average Complexity per Method
 * @property int $method_ccn_max Maximum Method Complexity
 * @property int $method_lloc_min Minimum Method Length
 * @property float $method_lloc_avg Average Method Length
 * @property int $method_lloc_max Maximum Method Length
 * @property int $namespaces Namespaces
 * @property int $ncloc Non-Comment Lines of Code (NCLOC)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Commit $commit
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereAbstractClasses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereAnonymousFunctions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereAttributeAccesses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereCcn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereCcnByLloc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereCcnMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereClassCcnAvg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereClassCcnMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereClassCcnMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereClassConstants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereClassLlocAvg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereClassLlocMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereClassLlocMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereClasses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereCloc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereCommitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereConcreteClasses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereConstants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereDirectories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereFunctions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereGlobalAccesses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereGlobalConstantAccesses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereGlobalConstants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereGlobalVariableAccesses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereInstanceAttributeAccesses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereInstanceMethodCalls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereInterfaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereLloc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereLlocByNof($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereLlocClasses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereLlocFunctions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereLlocGlobal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereLoc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereMethodCalls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereMethodCcnAvg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereMethodCcnMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereMethodCcnMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereMethodLlocAvg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereMethodLlocMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereMethodLlocMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereNamedFunctions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereNamespaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereNcloc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereNonPublicMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereNonStaticMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric wherePublicMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereStaticAttributeAccesses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereStaticMethodCalls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereStaticMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereSuperGlobalVariableAccesses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereTestClasses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereTestMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereTraits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $project_id
 * @property int|null $repository_id
 * @property-read \App\Models\Project|null $project
 * @property-read \App\Models\Repository|null $repository
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric whereRepositoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LocMetric forProject(\App\Models\Project $project)
 */
class LocMetric extends Model
{
    protected $fillable = [
        'project_id',
        'repository_id',
        'commit_id',
        'directories',
        'files',
        'loc',
        'lloc',
        'lloc_classes',
        'lloc_functions',
        'lloc_global',
        'cloc',
        'ccn',
        'ccn_methods',
        'interfaces',
        'traits',
        'classes',
        'abstract_classes',
        'concrete_classes',
        'functions',
        'named_functions',
        'anonymous_functions',
        'methods',
        'public_methods',
        'non_public_methods',
        'non_static_methods',
        'static_methods',
        'constants',
        'class_constants',
        'global_constants',
        'test_classes',
        'test_methods',
        'ccn_by_lloc',
        'lloc_by_nof',
        'method_calls',
        'static_method_calls',
        'instance_method_calls',
        'attribute_accesses',
        'static_attribute_accesses',
        'instance_attribute_accesses',
        'global_accesses',
        'global_variable_accesses',
        'super_global_variable_accesses',
        'global_constant_accesses',
        'class_ccn_min',
        'class_ccn_avg',
        'class_ccn_max',
        'class_lloc_min',
        'class_lloc_avg',
        'class_lloc_max',
        'method_ccn_min',
        'method_ccn_avg',
        'method_ccn_max',
        'method_lloc_min',
        'method_lloc_avg',
        'method_lloc_max',
        'namespaces',
        'ncloc',
    ];

    protected $casts = [
        'project_id' => 'integer',
        'repository_id' => 'integer',
        'commit_id' => 'integer',
        'directories' => 'integer',
        'files' => 'integer',
        'loc' => 'integer',
        'lloc' => 'integer',
        'lloc_classes' => 'integer',
        'lloc_functions' => 'integer',
        'lloc_global' => 'integer',
        'cloc' => 'integer',
        'ccn' => 'integer',
        'ccn_methods' => 'integer',
        'interfaces' => 'integer',
        'traits' => 'integer',
        'classes' => 'integer',
        'abstract_classes' => 'integer',
        'concrete_classes' => 'integer',
        'functions' => 'integer',
        'named_functions' => 'integer',
        'anonymous_functions' => 'integer',
        'methods' => 'integer',
        'public_methods' => 'integer',
        'non_public_methods' => 'integer',
        'non_static_methods' => 'integer',
        'static_methods' => 'integer',
        'constants' => 'integer',
        'class_constants' => 'integer',
        'global_constants' => 'integer',
        'test_classes' => 'integer',
        'test_methods' => 'integer',
        'ccn_by_lloc' => 'float',
        'lloc_by_nof' => 'float',
        'method_calls' => 'integer',
        'static_method_calls' => 'integer',
        'instance_method_calls' => 'integer',
        'attribute_accesses' => 'integer',
        'static_attribute_accesses' => 'integer',
        'instance_attribute_accesses' => 'integer',
        'global_accesses' => 'integer',
        'global_variable_accesses' => 'integer',
        'super_global_variable_accesses' => 'integer',
        'global_constant_accesses' => 'integer',
        'class_ccn_min' => 'integer',
        'class_ccn_avg' => 'float',
        'class_ccn_max' => 'integer',
        'class_lloc_min' => 'integer',
        'class_lloc_avg' => 'float',
        'class_lloc_max' => 'integer',
        'method_ccn_min' => 'integer',
        'method_ccn_avg' => 'float',
        'method_ccn_max' => 'integer',
        'method_lloc_min' => 'integer',
        'method_lloc_avg' => 'float',
        'method_lloc_max' => 'integer',
        'namespaces' => 'integer',
        'ncloc' => 'integer',
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
