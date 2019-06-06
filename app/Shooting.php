<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shooting extends Model
{
    protected $fillable = ['name', 'date', 'slug'];

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function models()
    {
        return $this->belongsToMany('App\Model');
    }

    public function getWithAttribute()
    {
        return $this->models->map(function ($item, $key) {
            return '<a href="'.route('models.show.slug', $item->slug).'">'.$item->name.'</a>';
        })->implode(', ');
    }
}
