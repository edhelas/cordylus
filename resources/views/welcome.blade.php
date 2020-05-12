@extends('layouts.app')

@section('content')

    <ul class="grid">
        <li><img src="img/1.jpg"></li>
        <li><img src="img/2.jpg"></li>
        <li><img src="img/3.jpg"></li>
        <li><img src="img/4.jpg"></li>
    </ul>

    <ul class="logo">
        <li>
            <a href="{{route('shootings.gallery')}}">
                <img src="img/folder.svg">Enter
            </a>
        </li>
    </ul>

    <p class="warning">
        This site contains dipictions of sexual acts involving latex and other subjects of an adult and fetishistic nature.
        <br />
        By proceeding you certify that you are over the age of consent to view material of this nature in your present location.
    </p>

    <ul class="logo second">
        <li>
            <a href="https://www.patreon.com/kinky_lab">
                <img src="img/patreon.svg">Patreon
            </a>
        </li><br />
        <li>
            <a href="https://www.instagram.com/shinyelensil/">
                <img src="img/instagram.svg">Instagram
            </a>
        </li>
        <li>
            <a href="https://twitter.com/Kinky_Lab">
                <img src="img/twitter.svg">Twitter
            </a>
        </li>
        <li>
            <a href="https://www.youtube.com/channel/UCfQmxAdCh01Wx8A8FtZU2_g">
                <img src="img/youtube.svg">YouTube
            </a>
        </li>
        <li>
            <a href="https://fetlife.com/users/1745697">
                <img src="img/fetlife.svg">Fetlife
            </a>
        </li>
        <li>
            <a href="https://www.etsy.com/shop/KinkyLab/">
                <img src="img/etsy.svg">Etsy
            </a>
        </li>
        <!--<li>
            <a href="https://ko-fi.com/shinyelensil">
                <img src="img/kofi.svg">Ko-fi
            </a>
        </li>-->
    </ul>
@endsection