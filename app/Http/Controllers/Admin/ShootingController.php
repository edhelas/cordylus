<?php

namespace App\Http\Controllers\Admin;

use App\Model;
use App\Shooting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShootingController extends Controller
{
    public function index()
    {
        return view('shootings.index', [
            'shootings' => Shooting::orderBy('date', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('shootings.create_edit', [
            'shooting' => new Shooting,
            'models' => Model::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'date' => 'date|required',
            'slug' => 'alpha_dash|unique:shootings|required',
            'published' => 'boolean',
            'hidden' => 'boolean'
        ]);

        Shooting::create($request
            ->merge(['exclusive_hash' => str_random(8), 'user_id' => $request->user()->id])
            ->only(['exclusive_hash', 'name', 'slug', 'date', 'location', 'published', 'comment', 'user_id', 'hidden']));

        return redirect()->route('shootings.index');
    }

    public function edit(Shooting $shooting)
    {
        if (!$shooting->isMine()) abort(403);

        return view('shootings.create_edit', [
            'shooting' => $shooting,
            'models' => Model::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $shooting = Shooting::findOrFail($id);

        if (!$shooting->isMine()) abort(403);

        $request->validate([
            'name' => 'string|required',
            'date' => 'date|required',
            'slug' => 'alpha_dash|required'
        ]);

        $shooting->fill($request->only(['name', 'slug', 'date', 'location', 'comment']));
        $shooting->published = $request->input('published', false);
        $shooting->hidden = $request->input('hidden', false);
        $shooting->save();

        return redirect()->route('shootings.edit', $id);
    }

    public function destroy($id)
    {
        //
    }
}
