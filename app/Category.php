<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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
