<?php

namespace App\Models;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property string|null $title Название страницы
 * @property string|null $meta_title Заголовок страницы для SEO
 * @property string|null $meta_keywords Ключевые слова для SEO
 * @property string|null $meta_description Описание для SEO
 * @property string|null $slug Название страницы транслитом для ЧПУ
 * @property string|null $content Содержимое страницы
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    //
    protected $fillable = [
        'title',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'slug',
        'content',
    ];
}