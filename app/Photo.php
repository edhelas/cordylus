<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Image;

class Photo extends Model
{
    protected $fillable = ['shooting_id', 'path'];
    private $sizes = ['s' => 128, 'm' => 256, 'l' => 512, 'xl' => 1920];

    public function shoot()
    {
        return $this->hasOne('App\Shooting');
    }

    public function path(string $size)
    {
        return $this->sizes[$size].'_'.$this->path;
    }

    public function createThumbnails()
    {
        foreach($this->sizes as $key => $size) {
            $this->createThumbnail($size);
        }
    }

    public function deleteThumbnails()
    {
        foreach($this->sizes as $key => $size) {
            File::delete(\storage_path('app/public/').$size.'_'.$this->path);
        }

        File::delete(\storage_path('app/public/').$this->path);
    }

    private function createThumbnail(int $size)
    {
        $path = \storage_path('app/public/');

        $thumb = Image::make($path.$this->path)->resize($size, $size, function ($constraint) {
            $constraint->aspectRatio();
        });
        $thumb->save($path.$size.'_'.$this->path, 80);
    }
}
