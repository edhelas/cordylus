<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Video extends Model
{
    protected $guarded = [];

    public function shoot()
    {
        return $this->hasOne('App\Shooting');
    }

    public function getCoverAttribute()
    {
        return 'storage/'. $this->attributes['cover'];
    }

    public function deleteCover()
    {
        //dd(\storage_path('app/public/').$this->attributes['cover']);
        File::delete(\storage_path('app/public/').$this->attributes['cover']);
    }
}
