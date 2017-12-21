<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;
    use Traits\UserSocialiteHelper;
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot() {
        parent::boot();
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'real_name', 'password', 'github_id', 'github_name', 'github_url', 'city', 'company', 'website', 'introduction', 'avatar', 'register_source',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 一个用户可以发布多个话题
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics() {
        return $this->hasMany(Topic::class);
    }

    /**
     * 定义用户话题投票关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function votedTopics() {
        return $this->belongsToMany(Topic::class, 'user_topic')->withTimestamps();
    }

    /**
     * 用户关注问题
     * @param Topic $topic
     * @return array
     */
    public function VotedTopicThis($topic) {
        return $this->votedTopics()->toggle($topic);
    }

    /**
     * 判断用户是否投票了某个话题
     * @param Topic $topic
     * @return bool
     */
    public function votedTopicd($topic) {
        return ! !$this->votedTopics()->where('topic_id', $topic)->count();
    }

    /**
     * 用户授权
     * @param $model
     * @return bool
     */
    public function isAuthorOf($model) {
        return $this->id == $model->user_id;
    }

    /**
     * 一个用户有多个评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies() {
        return $this->hasMany(Reply::class);
    }
}
