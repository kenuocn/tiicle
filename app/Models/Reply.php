<?php

namespace App\Models;

class Reply extends Model {
    protected $fillable = ['content'];

    /**
     * 一个回复属于一个话题
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    /**
     * 一个回复属于一个作者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
