<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VotedTopic
 *
 * @property-read \App\Models\Topic $topics
 * @property-read \App\Models\User $users
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id 关联用户id
 * @property int $topic_id 关联话题id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VotedTopic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VotedTopic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VotedTopic whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VotedTopic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VotedTopic whereUserId($value)
 */
class VotedTopic extends Model {
    protected $table = 'user_topic';

    /**
     * 一个话题对应多个用户
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function topics() {
        return $this->belongsTo(Topic::class, 'id', 'topic_id');
    }
}
