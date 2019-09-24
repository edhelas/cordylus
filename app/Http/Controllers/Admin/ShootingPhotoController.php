<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

use App\Shooting;
use App\Photo;

class ShootingPhotoController extends Controller
{
    public function create(Shooting $shooting)
    {
        $photo = new Photo;
        $photo->shooting_id = $shooting->id;

        return view('shootings.photos.create_edit', [
            'photo' => $photo
        ]);
    }

    public function store(Request $request)
    {
        $shooting = Shooting::findOrFail($request->input('shooting_id'));

        $request->validate([
            'photo' => 'image|required'
        ]);

        $name = $this->storeFile($request);

        $photo = Photo::create([
            'shooting_id' => $shooting->id,
            'path' => $name,
            'position' => $shooting->photos()->count(),
        ]);

        $photo->createThumbnails();

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function edit(Shooting $shooting, Photo $photo)
    {
        return view('shootings.photos.create_edit', [
            'photo' => $photo
        ]);
    }

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

        return redirect(route('shootings.edit', $shooting->id).'#'.$photoId);
    }

    public function publishAll(Shooting $shooting)
    {
        $shooting->photos()->update(['published' => true]);

        return redirect(route('shootings.edit', $shooting->id));
    }

    public function publish(Shooting $shooting, Photo $photo)
    {
        $photo->published = true;
        $photo->save();

        return redirect(route('shootings.edit', $shooting->id).'#'.$photo->id);
    }

    public function unpublish(Shooting $shooting, Photo $photo)
    {
        $photo->published = false;
        $photo->save();

        return redirect(route('shootings.edit', $shooting->id).'#'.$photo->id);
    }

    public function moveUp(Shooting $shooting, Photo $photo)
    {
        if ($photo->position <= 0) return;

        $previous = $shooting->photos()->where('position', $photo->position-1)->first();
        $previous->position = $photo->position;
        $previous->save();

        $photo->update(['position' => $photo->position--]);

        return redirect(route('shootings.edit', $shooting->id).'#'.$photo->id);
    }

    public function moveDown(Shooting $shooting, Photo $photo)
    {
        if ($photo->position >= $shooting->photos()->count()) return;

        $next = $shooting->photos()->where('position', $photo->position+1)->first();
        $next->position = $photo->position;
        $next->save();

        $photo->update(['position' => $photo->position++]);

        return redirect(route('shootings.edit', $shooting->id).'#'.$photo->id);
    }

    public function setExclusive(Shooting $shooting, Photo $photo)
    {
        $photo->exclusive = true;
        $photo->save();

        return redirect(route('shootings.edit', $shooting->id).'#'.$photo->id);
    }

    public function unsetExclusive(Shooting $shooting, Photo $photo)
    {
        $photo->exclusive = false;
        $photo->save();

        return redirect(route('shootings.edit', $shooting->id).'#'.$photo->id);
    }

    public function destroy(Shooting $shooting, Photo $photo)
    {
        $photo->deleteThumbnails();
        $photo->delete();

        if ($shooting->primary_photo_id == $photo->id) {
            $shooting->primary_photo_id = null;
            $shooting->save();
        }

        // We move the position of all the following pictures
        foreach ($shooting->photos()->where('position', '>', $photo->position)->get() as $photo) {
            $photo->position--;
            $photo->save();
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
