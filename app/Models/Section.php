<?php

namespace AElsukov\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Section
 * @package AElsukov\Model
 */
class Section extends Model
{
    /** @inheritDoc */
    protected $table = 'sections';

    /** @inheritDoc */
    public $fillable = [
        'name',
        'body',
        'parent_id',
        'active',
        'left_margin',
        'right_margin',
        'slug',
    ];
}
