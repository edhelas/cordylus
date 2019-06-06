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

        $file = $request->file('photo');
        $name = rand(1, 999) . $file->getClientOriginalName();
        $path = $file->storeAs('public', $name);

        $photo = Photo::create([
            'shooting_id' => $request->input('shooting_id'),
            'path' => $name
        ]);

        $photo->createThumbnails();

        return redirect()->route('shootings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

        return redirect()->route('shootings.index');
    }
}
