<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class UserController extends Controller
{
    public function edit(Request $request)
    {
        return view('users.edit', ['user' =>$request->user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'string|required',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'patreon' => 'nullable|string',
            'description' => 'nullable|string',
            'slug' => 'alpha_dash|required',
            'website' => 'nullable|string'
        ]);

        $user->fill($request->only(['name', 'slug', 'instagram', 'twitter', 'patreon', 'website', 'description']));
        $user->save();

        return redirect()->route('user.edit');
    }

}
