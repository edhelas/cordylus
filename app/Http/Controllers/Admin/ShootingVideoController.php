<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

use App\Shooting;
use App\Video;

class ShootingVideoController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Shooting $shooting)
    {
        $video = new Video;
        $video->shooting_id = $shooting->id;

        return view('shootings.videos.create_edit', [
            'video' => $video
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cover' => 'image|required',
            'preview_h264' => 'url|required',
            'preview_webm' => 'url|required',
        ]);

        $file = $request->file('cover');
        $name = rand(1, 999) . $file->getClientOriginalName();
        $file->storeAs('public', $name);

        $video = Video::create([
            'shooting_id' => $request->input('shooting_id'),
            'cover' => $name,
            'preview_h264' => $request->input('preview_h264'),
            'preview_webm' => $request->input('preview_webm'),
            '1080_h264' => $request->input('1080_h264'),
            '720_h264' => $request->input('720_h264'),
            '1080_webm' => $request->input('1080_webm'),
            '720_webm' => $request->input('720_webm'),
        ]);

        return redirect()->route('shootings.edit', $request->input('shooting_id'));
    }

    public function edit(Shooting $shooting, Video $video)
    {
        return view('shootings.videos.create_edit', [
            'video' => $video
        ]);
    }

    public function update(Shooting $shooting, Video $video, Request $request)
    {
        $request->validate([
            'photo' => 'image'
        ]);

        if ($request->file('cover')) {
            $video->deleteCover();

            $file = $request->file('cover');
            $name = rand(1, 999) . $file->getClientOriginalName();
            $file->storeAs('public', $name);
            $video->cover = $name;
        }

        $video->fill($request->only(['preview_h264', 'preview_webm', '1080_h264', '720_h264', '1080_webm', '720_webm']));
        $video->published = false;
        $video->save();

        return redirect()->route('shootings.edit', $request->input('shooting_id'));
    }


    public function publish(Shooting $shooting, Video $video)
    {
        $video->published = true;
        $video->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function unpublish(Shooting $shooting, Video $video)
    {
        $video->published = false;
        $video->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function setExclusive(Shooting $shooting, Video $video)
    {
        $video->exclusive = true;
        $video->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function unsetExclusive(Shooting $shooting, Video $video)
    {
        $video->exclusive = false;
        $video->save();

        return redirect()->route('shootings.edit', $shooting->id);
    }
}
