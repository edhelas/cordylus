<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model;
use App\Shooting;
use App\Photo;

class ModelPhotoController extends Controller
{
    public function create(Request $request, string $hash)
    {
        $modelShooting = \DB::table('model_shooting')
                           ->where('hash', $hash)
                           ->first();

        if (!$modelShooting) abort(404);

        $photo = Photo::find($request->input('photo_id'));

        if ($photo->published) abort(403);

        $model = Model::find($modelShooting->model_id);
        $model->photos()->detach($request->input('photo_id'));
        $model->photos()->attach($request->input('photo_id'), [
            'validated' => $request->input('validated', false),
            'comment' => $request->input('comment')
        ]);

        return redirect()->route('shooting.model.show.hash', ['hash' => $hash, '#'.$request->input('photo_id')]);
    }
}