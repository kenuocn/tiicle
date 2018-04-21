<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Message
 *
 * @property-read \App\Models\User $fromUser
 * @property-read \App\Models\User $toUser
 * @mixin \Eloquent
 * @property int $id
 * @property int $from_user_id 发送者的用户id
 * @property int $to_user_id 接受者的用户id
 * @property string $body 私信内容
 * @property string|null $read_time 阅读时间
 * @property int $is_read 是否已阅读,0未读,1已读
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereFromUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereReadTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereToUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereUpdatedAt($value)
 */
class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['from_user_id','to_user_id','body'];

    /**
     * 发送私信用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }

    /**
     * 私信接受者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user_id');
    }
}
