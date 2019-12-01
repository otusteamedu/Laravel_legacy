<?php

namespace App\Models;

use App\Services\Events\Models\Favorite\FavoriteSaved;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Favorite
 * @property int id
 * @property User user_id
 * @property Material material_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class Favorite extends Model {
   protected $fillable=['user_id', 'material_id'];

    protected $dispatchesEvents = [
        'saved' => FavoriteSaved::class
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
   }
    public function materials() {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

}
