<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

use App\Shooting;
use App\Photo;

class ShootingPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shooting $shooting)
    {
        $photo = new Photo;
        $photo->shooting_id = $shooting->id;

        return view('shootings.photos.create_edit', [
            'photo' => $photo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|required'
        ]);

        $name = $this->storeFile($request);

        $photo = Photo::create([
            'shooting_id' => $request->input('shooting_id'),
            'path' => $name
        ]);

        $photo->createThumbnails();

        return redirect()->route('shootings.edit', $request->input('shooting_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shooting $shooting, Photo $photo)
    {
        return view('shootings.photos.create_edit', [
            'photo' => $photo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Shooting $shooting, Photo $photo, Request $request)
    {
        $request->validate([
            'photo' => 'image|required'
        ]);

        $photo->deleteThumbnails();

        $photo->path = $this->storeFile($request);
        $photo->save();

        $photo->createThumbnails();

        return redirect()->route('shootings.edit', $request->input('shooting_id'));
    }

    public function setPrimary(Shooting $shooting, int $photoId)
    {
        $shooting->primary_photo_id = $photoId;
        $shooting->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function publish(Shooting $shooting, Photo $photo)
    {
        $photo->published = true;
        $photo->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function unpublish(Shooting $shooting, Photo $photo)
    {
        $photo->published = false;
        $photo->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function setExclusive(Shooting $shooting, Photo $photo)
    {
        $photo->exclusive = true;
        $photo->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function unsetExclusive(Shooting $shooting, Photo $photo)
    {
        $photo->exclusive = false;
        $photo->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shooting $shooting, Photo $photo)
    {
        $photo->deleteThumbnails();
        $photo->delete();

        if ($shooting->primary_photo_id == $photo->id) {
            $shooting->primary_photo_id = null;
            $shooting->save();
        }

        return redirect()->route('shootings.edit', $shooting->id);
    }

    private function storeFile(Request $request): string
    {
        $file = $request->file('photo');
        $name = rand(1, 999) . $file->getClientOriginalName();
        $file->storeAs('public', $name);

        return $name;
    }
}
