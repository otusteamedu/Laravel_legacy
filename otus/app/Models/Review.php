<?php

namespace App\Models;

use App\Services\Events\Models\Review\ReviewSaved;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * @property int id
 * @property User user_id
 * @property Material material_id
 * @property string review
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class Review extends Model {
    protected $fillable = ['user_id', 'material_id', 'review'];

    protected $dispatchesEvents = [
        'saved' => ReviewSaved::class
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function material() {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }
}
