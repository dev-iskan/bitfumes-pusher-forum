<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($question) {
            $question->slug = str_slug($question->title);
        });
    }

    protected $with = ['replies'];

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
        return "/question/$this->slug";
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies () {
        return $this->hasMany(Reply::class)->latest();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
