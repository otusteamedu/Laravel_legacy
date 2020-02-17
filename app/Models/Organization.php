<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Organization
 *
 * @property int $id
 * @property string $name
 * @property string $name_eng
 * @property int|null $country_id
 * @property int|null $org_type_id
 * @property int|null $org_group_id
 * @property int|null $org_branch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\OrgBranch $orgBranch
 * @property-read \App\Models\OrgGroup $orgGroup
 * @property-read \App\Models\OrgType $orgType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereNameEng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereOrgBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereOrgGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereOrgTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organization whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Organization extends Model
{
    public function country() {
        return $this->belongsTo('App\Models\Country');
    }
    public function orgBranch() {
        return $this->belongsTo('App\Models\orgBranch');
    }
    public function orgGroup() {
        return $this->belongsTo('App\Models\orgGroup');
    }
    public function orgType() {
        return $this->belongsTo('App\Models\orgType');
    }
}
