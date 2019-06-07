<?php

namespace App\Http\Controllers\Admin;

use App\Model;
use App\Shooting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShootingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shootings.index', [
            'shootings' => Shooting::orderBy('date', 'desc')->get(),
            'models' => Model::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shootings.create_edit', [
            'shooting' => new Shooting
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
            'date' => 'date|required',
            'slug' => 'alpha_dash|required',
            'location' => 'string'
        ]);

        Shooting::create($request->only(['name', 'slug', 'date', 'location']));

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
    public function edit(Shooting $shooting)
    {
        return view('shootings.create_edit', [
            'shooting' => $shooting
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
        $shooting = Shooting::findOrFail($id);

        $request->validate([
            'name' => 'string|required',
            'date' => 'date|required',
            'slug' => 'alpha_dash|required',
            'location' => 'string'
        ]);

        $shooting->fill($request->only(['name', 'slug', 'date', 'location']));
        $shooting->save();

        return redirect()->route('shootings.index');
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
