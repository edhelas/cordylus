<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shooting extends Model
{
    protected $dates = ['date'];
    protected $guarded = [];

    public function videos()
    {
        return $this->hasMany('App\Video')->orderBy('created_at');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo')->orderBy('created_at');
    }

    public function models()
    {
        return $this->belongsToMany('App\Model')->withPivot('hash');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function isMine()
    {
        return ($this->user_id == \Auth::user()->id);
    }

    public function getStringDescriptionAttribute()
    {
        $description = $this->date->format('M j, Y');

        $description .= $this->models()->count() > 0
                ? ' with ' . $this->models->map(function ($item, $key) {
                        return $item->name;
                    })->implode(', ')
                : '';
        $description .= !empty($this->location)
                ? ' – '.$this->location
                : '';

        return $description;
    }

    public function getDescriptionAttribute()
    {
        $description = $this->date->format('M j, Y');

        $description .= !empty($this->getWithAttribute())
                ? ' with ' . $this->getWithAttribute()
                : '';
        $description .= !empty($this->location)
                ? ' – '.$this->location
                : '';

        return $description;
    }

    public function getWithAttribute()
    {
        return $this->models->map(function ($item, $key) {
            return '<a href="'.route('models.show.slug', $item->slug).'">'.$item->name.'</a>';
        })->implode(', ');
    }

    public function getPrimaryAttribute()
    {
        if ($this->primary_photo_id
        && $first = $this->photos()
            ->where('published', true)
            ->where('id', $this->primary_photo_id)
            ->first()) {
            return $first;
        }

        $first = $this->photos()->where('published', true)->first();

        if ($first) return $first;

        $placeholder = new \App\Photo;
        $placeholder->published = true;
        return $placeholder;
    }
}
