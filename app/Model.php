<?php

namespace App;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $fillable = ['name', 'instagram', 'slug', 'website', 'twitter', 'patreon'];

    public function shootings()
    {
        return $this->belongsToMany('App\Shooting');
    }

    public function photos()
    {
        return $this->belongsToMany('App\Photo')->withPivot('validated', 'comment')->withTimestamps();
    }

    public function getPrimaryAttribute(): ?Photo
    {
        return $this->shootings()->where('published', true)->latest()->first()?->primary;
    }
}
