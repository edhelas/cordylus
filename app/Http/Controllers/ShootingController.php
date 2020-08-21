<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
            'shootings' => Shooting::notHidden()->orderBy('created_at', 'desc')->published()->get()
        ]);
    }

    public function feed()
    {
        $shootings = Shooting::notHidden()->with('author')->orderBy('created_at', 'desc')->published()->get();

        header("Content-Type: application/atom+xml; charset=UTF-8");
        header('Content-Disposition: attachment; filename="'.config('app.name').'.atom"');

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $feed = $dom->createElementNS('http://www.w3.org/2005/Atom', 'feed');
        $dom->appendChild($feed);

        $feed->appendChild($dom->createElement('updated', date('c')));
        $feed->appendChild($self = $dom->createElement('link'));
        $self->setAttribute('rel', 'self');
        $self->setAttribute('href', route('shootings.feed'));

        $feed->appendChild($dom->createElement('id', route('welcome').'/'));

        $feed->appendChild($alternate = $dom->createElement('link'));
        $alternate->setAttribute('rel', 'alternate');
        $alternate->setAttribute('href', route('welcome'));

        $feed->appendChild($dom->createElement('title', config('app.name')));
        $feed->appendChild($dom->createElement('logo', asset('/img/256.png')));

        foreach ($shootings as $shooting) {
            $feed->appendChild($entry = $dom->createElement('entry'));

            $entry->appendChild($dom->createElement('title', htmlentities($shooting->name)));
            $entry->appendChild($dom->createElement('id', route('shootings.show.slug', $shooting->slug)));
            $entry->appendChild($dom->createElement('updated', date('c', strtotime($shooting->created_at))));

            $entry->appendChild($author = $dom->createElement('author'));
            $author->appendChild($dom->createElement('name', $shooting->author->name));
            $author->appendChild($dom->createElement('uri', route('authors.show.slug', $shooting->author->slug)));

            $entry->appendChild($content = $dom->createElement('content'));
            $content->appendChild($div = $dom->createElementNS('http://www.w3.org/1999/xhtml', 'div'));
            $content->setAttribute('type', 'xhtml');

            $count = $shooting->photos()->count() + $shooting->videos()->count();
            $p = '<p>' .  (string)$count . ' medias by <a href="' . route('authors.show.slug', $shooting->author->slug).'">'. $shooting->author->name .'</a>';

            if (!empty($shooting->with)) {
                $p .= ' with '. $shooting->with;
            }

            $p .= '</p>';

            $f = $dom->createDocumentFragment();
            $f->appendXML($p);

            $div->appendChild($f);

            if ($shooting->primary) {
                $entry->appendChild($link = $dom->createElement('link'));
                $link->setAttribute('rel', 'enclosure');
                $link->setAttribute('type', 'image/jpeg');
                $link->setAttribute('href', asset($shooting->primary->path('l')));
            }

            $entry->appendChild($link = $dom->createElement('link'));
            $link->setAttribute('rel', 'alternate');
            $link->setAttribute('href', route('shootings.show.slug', $shooting->slug));
        }

        echo $dom->saveXML();
        exit;
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
