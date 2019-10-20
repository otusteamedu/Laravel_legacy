<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Справочник контрагентов.
 *
 * Class Counterparty
 *
 * @property int            $id
 * @property string         $title
 * @property string         $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $delete_at
 */
class Counterparty extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'comment',
    ];
}
