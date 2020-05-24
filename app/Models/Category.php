<?php

namespace App\Models;

use App\Models\Lang\Ru\Category as CategoryRu;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'group_id', 'position'
    ];

    public function nameRu($name)
    {
        $categoryRu = CategoryRu::where('category_id', $this->id)->first();

        if (!$categoryRu) {
            $categoryRu = new CategoryRu();
            $categoryRu->category_id = $this->id;
        }

        $categoryRu->name = $name;

        $categoryRu->save();

        return $categoryRu;
    }
}
