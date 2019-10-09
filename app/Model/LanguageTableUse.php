<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\LanguageRepository
 *
 * @property int $id
 * @property string|null $language_name
 * @property int $function_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageTableUse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageTableUse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageTableUse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageTableUse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageTableUse whereFunctionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageTableUse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageTableUse whereLanguageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageTableUse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LanguageTableUse extends Model
{
    //
}
