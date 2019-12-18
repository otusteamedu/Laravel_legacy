<?php

namespace App\Models;

use App\Services\Events\Models\Handbook\HandbookSaved;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Handbook
 * @property int id
 * @property string code
 * @property string name
 * @property string description
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class Handbook extends Model {

    protected $dispatchesEvents = [
        'saved' => HandbookSaved::class
    ];

    protected $fillable = ['code', 'name', 'description'];
}
