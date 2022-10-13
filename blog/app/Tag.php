<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    public function posts() {
        return $this->belongsToMany(Post::class)->withTimestamps();;
    }
    public static function popular() {
        return self::withCount('posts')->orderByDesc('posts_count')->limit(10)->get();
    }
}
