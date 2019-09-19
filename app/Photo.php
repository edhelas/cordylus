<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Image;

class Photo extends Model
{
    protected $fillable = ['shooting_id', 'path', 'published', 'position'];
    private $sizes = ['s' => 128, 'm' => 256, 'sl' => 512, 'ml' => 768, 'l' => 1024, 'xl' => 1536, 'xxl' => 1920];

    public function shoot()
    {
        return $this->hasOne('App\Shooting');
    }

    public function path(string $size = 'm', string $format = 'jpg')
    {
        if (isset($this->attributes['path'])) {
            if ($size == 'blurred') {
                return 'storage/'.$this->getHash('blurred_'.$this->attributes['path']).'.'.$format;
            }

            if ($size == 'o') {
                return 'storage/'.$this->attributes['path'];
            }

            return 'storage/'.$this->getHash($this->sizes[$size].'_'.$this->attributes['path']).'.'.$format;
        }

        return 'img/placeholder.jpg';
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

        $this->createBlurred();
    }

    private function createBlurred()
    {
        $path = \storage_path('app/public/');

        $blurred = Image::make($path.$this->path)->resize($this->sizes['xxl'], $this->sizes['xxl'], function ($constraint) {
            $constraint->aspectRatio();
        });

        $blurred->blur(100);
        $blurred->save($path.$this->getHash('blurred_'.$this->path).'.jpg', 90);
        $blurred->save($path.$this->getHash('blurred_'.$this->path).'.webp', 90);
    }

    public function deleteThumbnails($original = true)
    {
        foreach($this->sizes as $key => $size) {
            File::delete(\storage_path('app/public/').$this->getHash($size.'_'.$this->path).'.jpg');
            File::delete(\storage_path('app/public/').$this->getHash($size.'_'.$this->path).'.webp');
        }

        File::delete(\storage_path('app/public/').$this->getHash('blurred_'.$this->path).'.jpg');
        File::delete(\storage_path('app/public/').$this->getHash('blurred_'.$this->path).'.webp');

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
        $thumb->save($path.$this->getHash($size.'_'.$this->path).'.jpg', 95);
        $thumb->save($path.$this->getHash($size.'_'.$this->path).'.webp', 95);
    }

    private function getHash($filePath)
    {
        return hash('sha256', $filePath);
    }
}
