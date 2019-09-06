@extends('layouts.app')

@section('subtitle')About Us @endsection

@section('content')

<article>
    <h2>Authors</h2>

    @foreach ($authors as $author)
        <h3 class="center"><a href="{{route('authors.show.slug', $author->slug)}}">{{ $author->name }}</a><h3>

        <h4 class="links center">
            @if ($author->instagram)
                <a href="https://www.instagram.com/{{$author->instagram}}" target="_blank">Instagram</a>
            @endif
            @if ($author->website)
                <a href="{{$author->website}}" target="_blank">Website</a>
            @endif
            @if ($author->patreon)
                <a href="https://www.patreon.com/{{$author->patreon}}" target="_blank">Patreon</a>
            @endif
            @if ($author->twitter)
                <a href="https://twitter.com/{{$author->twitter}}" target="_blank">Twitter</a>
            @endif
        </h4>

        <p>{{$author->description}}</p>
    @endforeach

    <hr >

    <h2>Support Us</h2>

    <p>KinkyLab is a project by latex fetishist for latex fetishist.</p>

    <p>Some of our content is restricted to help us covering our expenses and continuously improving what we want to offer to our kinksters.</p>

    <p>If you like what we're doing you can support us on <a href="https://www.patreon.com/kinky_lab">Patreon</a> and unlock all our content for a few bucks per month.</p>

    <!--<h2>Licence</h2>

    <p>All our content is in the Public Domain. Feel free to share it :)<p>

    <p>We would still be really happy if you mention us and our models while sharing the kinky stuff around.</p>

    <h2>Latex Gears</h2>

    <p>The latex gears on our pictures are coming from really various places. We are making most of our accessories ourselves, you can buy them on our <a href="https://www.etsy.com/shop/KinkyLab">Etsy</a> shop.</p>

    <ul>
        <li>For the suits we recommend <a href="http://www.brightandshiny.pl/">Bright & Shiny</a> and <a href="https://www.fantasticrubber.de/">Fantastic Rubber</a></li>
        <li>For the hoods we strongly recommend <a href="https://www.gumique.com/">Gumique</a></li>
        <li>For the gloves, socks and other rubber accessories we also recommend <a href="https://www.rubberfashion.de/">Rubber Fashion</a> and <a href="http://latexa.com/">Latexa</a> (gloves available on teh Bright & Shiny store).</li>
    </ul>

    <p>If you are interested to know more about some gears or accessories, you can contact us via <a href="https://www.instagram.com/shinyelensil/">Instagram</a>.</p>

    <h2>Photo gears</h2>

    <p>Most of the pictures are shot using Canon cameras and lenses, especially using the Canon 80D and the 50mm STM lens.</p>

    <h2>Softwares</h2>

    <p>All our pictures and videos are edited using Free and OpenSource Softwares.</p>
    <p>The RAW pictures are developped using  <a href="https://www.darktable.org/">Darktable</a> and <a href="https://www.gimp.org/">TheGimp</a>, logos and other screens are made using <a href="https://inkscape.org/">Inkscape</a> and videos are edited using <a href="https://kdenlive.org/">Kdenlive</a> and converted using <a href="https://handbrake.fr/">HandBrake</a>.</p>

    <p>This website has been developped and is hosted using only Free Softwares such as nginx, PostgreSQL, PHP and Debian.</p>-->
</article>

@endsection
