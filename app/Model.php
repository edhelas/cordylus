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

    public function shootingsPhotos()
    {
        return $this->belongsToMany('App\Photo')->whereIn('shooting_id', function ($query) {
            $query->select('shooting_id')
                  ->from('model_shooting')
                  ->where('model_id', $this->id);
        })->withTimestamps();
    }

    public function getPrimaryAttribute()
    {
        $this->shootingsPhotos()
            ->where('published', true)
            ->latest();
    }
}
