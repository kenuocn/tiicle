<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @mixin \Eloquent
 */
class Category extends Model {
    protected $fillable = [
        'name', 'pic', 'description',
    ];
}
