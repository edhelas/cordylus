<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model;
use App\Shooting;

class ShootingModelController extends Controller
{
    public function show(string $hash)
    {
        $modelShooting = \DB::table('model_shooting')
                           ->where('hash', $hash)
                           ->first();

        if (!$modelShooting) abort(404);

        return view('models.hash', [
            'hash' => $hash,
            'model' => Model::find($modelShooting->model_id),
            'shooting' => Shooting::find($modelShooting->shooting_id)
        ]);
    }

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