<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shooting extends Model
{
    protected $dates = ['date'];
    protected $fillable = ['name', 'date', 'slug', 'primary_photo_id', 'location'];

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

    public function getPrimaryAttribute()
    {
        if ($this->primary_photo_id) {
            return $this->photos()->where('id', $this->primary_photo_id)->first();
        }

        return $this->photos()->first();
    }
}
