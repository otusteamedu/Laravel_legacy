<?php

namespace App\Models;

use App\Services\Events\Models\SelectionMaterial\SelectionMaterialSaved;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SelectionMaterial
 * @property int id
 * @property string name
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class SelectionMaterial extends Model {
    protected $fillable = ['name'];

    protected $dispatchesEvents = [
        'saved' => SelectionMaterialSaved::class
    ];
}