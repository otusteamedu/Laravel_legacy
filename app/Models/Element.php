<?php

namespace AElsukov\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Element
 * @package AElsukov\Model
 */
class Element extends Model
{
    /** @inheritDoc */
    protected $table = 'elements';

    /** @inheritDoc */
    public $fillable = [
        'name',
        'body',
        'section_id',
        'active',
        'slug',
    ];
}
