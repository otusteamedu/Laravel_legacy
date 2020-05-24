<?php

namespace App\Models;

use App\Models\Lang\Ru\CategoryGroup as CategoryGroupRu;

/**
 * App\Models\CategoryGroup
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CategoryGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'position'
    ];

    public function nameRu($name)
    {
        $groupRu = CategoryGroupRu::where('category_group_id', $this->id)->first();

        if (!$groupRu) {
            $groupRu = new CategoryGroupRu();
            $groupRu->category_group_id = $this->id;
        }

        $groupRu->name = $name;

        $groupRu->save();

        return $groupRu;
    }
}
