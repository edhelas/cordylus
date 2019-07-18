<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
    public function show($slug)
    {
        $author = User::where('slug', $slug)->firstOrFail();

        // We reuse the model view
        return view('models.show', [
            'model' => $author
        ]);
    }

    public function about()
    {
        return view('about', ['authors' => User::all()]);
    }
}
