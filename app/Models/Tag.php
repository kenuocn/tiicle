<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string|null $name 标签名称
 * @property string|null $images 标签图标
 * @property string|null $describe 描述
 * @property int|null $topics_count 关联话题总数
 * @property int|null $follows_count 关联话题总数
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereDescribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereFollowsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereTopicsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{

    protected $fillable = ['name', 'images', 'describe', 'topics_count', 'follows_count'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_tag')->withTimestamps();
    }

    /**
     * 返回id格式数组
     * @param $tags
     * @return array
     */
    public function normalizeTag($tags)
    {
        return collect($tags)->map(function ($tag) {

            if (is_numeric($tag)) {

                $tags = self::find($tag);
                $tags->increment('topics_count');

                return (int) $tag;
            }

            $tags = self::where('name',$tag)->first();

            if(is_null($tags))
            {
                $tags = self::create([
                    'name'=>$tag,
                    'topics_count'=>1,
                ]);

                return $tags->id;
            }

            $tags->increment('topics_count');

            return $tags->id;

        })->toArray();
    }

}
