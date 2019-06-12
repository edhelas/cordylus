<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Shooting;

class ShootingController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        return view('shootings.gallery', [
            'shootings' => Shooting::orderBy('date', 'desc')->published()->get()
        ]);
    }

    public function show($slug)
    {
        $shooting = Shooting::where('slug', $slug)->published()->firstOrFail();

        return view('shootings.show', [
            'shooting' => $shooting
        ]);
    }
}
