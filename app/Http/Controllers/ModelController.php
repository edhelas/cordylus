<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model;

class ModelController extends Controller
{
    public function show($slug)
    {
        $model = Model::where('slug', $slug)->firstOrFail();

        return view('models.show', [
            'model' => $model
        ]);
    }
}
