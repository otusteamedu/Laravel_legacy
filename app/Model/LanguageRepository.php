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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageRepository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageRepository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageRepository query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageRepository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageRepository whereFunctionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageRepository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageRepository whereLanguageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\LanguageRepository whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LanguageRepository extends Model
{
    //
}
