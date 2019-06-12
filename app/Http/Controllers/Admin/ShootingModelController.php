<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model;
use App\Shooting;

class ShootingModelController extends Controller
{
    public function create(Shooting $shooting, Request $request)
    {
        $request->validate([
            'model_id' => 'exists:models,id'
        ]);

        $shooting->models()->attach($request->input('model_id'), ['hash' => str_random(8)]);

        return redirect()->route('shootings.edit', $shooting->id);
    }

    public function destroy(Shooting $shooting, $modelId)
    {
        $shooting->models()->detach($modelId);

        return redirect()->route('shootings.edit', $shooting->id);
    }
}