<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($category) {
            $category->slug = str_slug($category->title);
        });
    }
    protected $fillable = [
        'title',
        'slug'
    ];
    public function questions () {
        return $this->hasMany(Question::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
