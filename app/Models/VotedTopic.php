<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotedTopic extends Model
{
    protected $table = 'user_topic';

    /**
     * 一个话题对应多个用户
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class,'id','topic_id');
    }
}
