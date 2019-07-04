<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shooting extends Model
{
    protected $dates = ['date'];
    protected $fillable = ['name', 'date', 'slug', 'primary_photo_id', 'location', 'comment', 'published', 'exclusive_hash'];

    public function videos()
    {
        return $this->hasMany('App\Video')->orderBy('created_at');
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
