<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model;
use MetaTag;

class ModelController extends Controller
{
    public function show($slug)
    {
        $model = Model::where('slug', $slug)->firstOrFail();

        MetaTag::set('title', '/KinkyLab/ – ' . $model->name);

        if ($model->shootings()->first()) {
            MetaTag::set('image', asset($model->shootings()->first()->primary->path('l')));
        }

        return view('models.show', [
            'model' => $model
        ]);
    }
}
