<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\TelegramUser
 *
 * @property int $id
 * @property bool|null $is_bot
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $username
 * @property string $language_code
 * @property int|null $user_id
 * @property int|null $default_group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereIsBot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereLanguageCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TelegramUser whereUsername($value)
 * @mixin \Eloquent
 */
class TelegramUser extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'is_bot',
        'first_name',
        'last_name',
        'username',
        'language_code',
        'user_id',
        'default_group',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'default_group', 'id')->withDefault();
    }

    /**
     * @return int
     */
    public function routeNotificationForTelegram(): int
    {
        $this->telegram_user_id = $this->id;

        return $this->telegram_user_id;
    }
}
