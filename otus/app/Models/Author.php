<?php

namespace App\Models;

use App\Services\Events\Models\Author\AuthorSaved;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 * @property int id
 * @property string name
 * @property string surname
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class Author extends Model {

    protected $dispatchesEvents = [
        'saved' => AuthorSaved::class
    ];

    protected $fillable = ['name', 'surname'];

    public function materials() {
        return $this->belongsToMany(Material::class, 'author_material', 'author_id', 'material_id');
    }
}
