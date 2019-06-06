<?php

namespace App;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $fillable = ['name', 'instagram', 'slug', 'website'];

    public function shootings()
    {
        return $this->belongsToMany('App\Shooting');
    }
}
