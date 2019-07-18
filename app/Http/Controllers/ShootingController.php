<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Shooting;
use MetaTag;

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

    public function show(string $slug, string $exclusiveHash = null)
    {
        $shooting = Shooting::where('slug', $slug)->published()->firstOrFail();

        MetaTag::set('title', '/KinkyLab/ – ' . $shooting->name);
        MetaTag::set('description', $shooting->stringDescription);
        MetaTag::set('image', asset($shooting->primary->path('l')));

        return view('shootings.show', [
            'shooting' => $shooting,
            'exclusive' => ($shooting->exclusive_hash == $exclusiveHash)
        ]);
    }
}
