<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('models.index', [
            'models' => Model::orderBy('name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.create_edit', [
            'model' => new Model
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
            'name' => 'string|required',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'patreon' => 'nullable|string',
            'slug' => 'alpha_dash|required',
            'website' => 'nullable|string'
        ]);

        Model::create($request->only(['name', 'instagram', 'twitter', 'patreon', 'slug', 'website']));

        return redirect()->route('models.index');
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
    public function edit(Model $model)
    {
        return view('models.create_edit', [
            'model' => $model
        ]);
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
        $model = Model::findOrFail($id);

        $request->validate([
            'name' => 'string|required',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'patreon' => 'nullable|string',
            'slug' => 'alpha_dash|required',
            'website' => 'nullable|string'
        ]);

        $model->fill($request->only(['name', 'slug', 'instagram', 'twitter', 'patreon', 'website']));
        $model->save();

        return redirect()->route('models.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
