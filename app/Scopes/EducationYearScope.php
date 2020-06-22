<?php

namespace App\Scopes;

use App\Models\EducationYear;
use App\Services\Helpers\Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class EducationYearScope implements Scope
{
    /**
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        if (!($educationYear = session(Session::EDUCATION_YEAR))) {
            $educationYear = EducationYear::date(Carbon::now())->select('id')->first()->id;
            session([Session::EDUCATION_YEAR => $educationYear]);
        }

        $builder->whereHas('year', function (Builder $builder) use ($educationYear): Builder {
            return $builder->where('id', $educationYear);
        });
    }
}
