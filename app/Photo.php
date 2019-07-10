<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Image;

class Photo extends Model
{
    protected $fillable = ['shooting_id', 'path', 'published'];
    private $sizes = ['s' => 128, 'm' => 256, 'sl' => 512, 'ml' => 768, 'l' => 1024, 'xl' => 1536, 'xxl' => 1920];

    public function shoot()
    {
        return $this->hasOne('App\Shooting');
    }

    public function path(string $size = 'm', string $format = 'jpg')
    {
        return isset($this->attributes['path'])
            ? $size == 'o'
                ? 'storage/'.$this->attributes['path']
                : 'storage/'.$this->getHash($this->sizes[$size].'_'.$this->attributes['path']).'.'.$format
            : 'img/placeholder.jpg';
    }

    public function models()
    {
        return $this->belongsToMany('App\Model')->withPivot('validated', 'comment')->withTimestamps();
    }

    public function model($modelId)
    {
        return $this->models()->find($modelId);
    }

    public function createThumbnails()
    {
        foreach($this->sizes as $key => $size) {
            $this->createThumbnail($size);
        }
    }

    public function deleteThumbnails($original = true)
    {
        foreach($this->sizes as $key => $size) {
            File::delete(\storage_path('app/public/').$this->getHash($size.'_'.$this->path).'.jpg');
            File::delete(\storage_path('app/public/').$this->getHash($size.'_'.$this->path).'.webp');
        }

        if ($original) {
            File::delete(\storage_path('app/public/').$this->path);
        }
    }

    private function createThumbnail(int $size)
    {
        $path = \storage_path('app/public/');

        $thumb = Image::make($path.$this->path)->resize($size, $size, function ($constraint) {
            $constraint->aspectRatio();
        });
        $thumb->save($path.$this->getHash($size.'_'.$this->path).'.jpg', 80);
        $thumb->save($path.$this->getHash($size.'_'.$this->path).'.webp', 80);
    }

    private function getHash($filePath)
    {
        return hash('sha256', $filePath);
    }
}
