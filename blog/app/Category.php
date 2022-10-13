<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    /**
     * Связь модели Category с моделью Post, позволяет получить
     * все посты, размещенные в текущей категории
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Связь модели Category с моделью Category, позволяет получить
     * родителя текущей категории
     */
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Возвращает список корневых категорий каталога товаров
     */
    public static function roots() {
        return self::where('parent_id', 0)->get();
    }
}
