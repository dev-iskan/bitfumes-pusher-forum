<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'category_id',
        'user_id'
    ];
    public function getRouteKeyName () {
        return 'slug';
    }

    public function getPathAttribute() {
        return asset("api/question/$this->slug");
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies () {
        return $this->hasMany(Reply::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
