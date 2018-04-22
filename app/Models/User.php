<?php

namespace App\Models;

use Auth;
use App\Models\Traits\ActiveUserHelper;
use Illuminate\Notifications\Notifiable;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Topic[] $topics
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Topic[] $votedTopics
 * @mixin \Eloquent
 * @property int $id
 * @property string $name 昵称
 * @property string $email 邮箱
 * @property int|null $github_id githubId
 * @property string|null $github_name github名称
 * @property string|null $github_url githubUrl
 * @property string $password 密码
 * @property string|null $city 城市
 * @property string|null $company 公司
 * @property string|null $introduction 自我介绍
 * @property int $notification_count 通知总数
 * @property string|null $real_name 真实名称
 * @property string|null $avatar 头像
 * @property string|null $register_source 注册方式
 * @property int $is_banned 是否禁止用户
 * @property int $email_notify_enabled 邮箱是否激活
 * @property string|null $last_actived_at 最后活跃时间
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $website 个人网站
 * @property int $gender 性别: 0未知,1男,2女
 * @property int $contribution_count 贡献总数
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereContributionCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailNotifyEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGithubName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGithubUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastActivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNotificationCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRegisterSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWebsite($value)
 */
class User extends Authenticatable {
    use Notifiable {
        notify as protected laravelNotify;
    }
    use ActiveUserHelper;
    use RevisionableTrait;
    use Traits\UserSocialiteHelper;

    public static function boot() {
        parent::boot();
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','gender', 'real_name', 'password', 'github_id', 'github_name', 'github_url', 'city', 'company', 'website', 'introduction', 'avatar', 'register_source',
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

    /**
     * 一个用户可以关注多个用户.一个用户也可以被多个用户关注
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(self::class,'user_followers','follower_id','followed_id')->withTimestamps();
    }

    /**
     * 关注用户
     * @param $user
     * @return array
     */
    public function toggleFollow($user)
    {
        return $this->followers()->toggle($user);
    }

    /**
     * 判断是否关注了某个用户
     * @param int $user_id
     * @return bool
     */
    public function isFollowing(int $user_id)
    {
        return !!$this->followers()->where('followed_id',$user_id)->count();
    }

    /**
     * 一个用户可以发送多个私信
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class,'to_user_id');
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        /**
         * 当前评论用户的id是否和当前登录用户的id一样
         */
        if ($this->id == Auth::id())
        {
            return;
        }

        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * 将通知总数清空
     */
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}
