@extends('layouts.app')

@section('subtitle'){{$shooting->name}}@endsection

@section('subsubtitle')
<h3>
    {{$shooting->date->format('M j, Y')}}
    @if (!empty($shooting->with))
        with {!! $shooting->with !!}
    @endif
    @if (!empty($shooting->location))
        - {{$shooting->location}}
    @endif
<h3>
@endsection

@section('content')
    <ul class="gallery">
        @foreach ($shooting->photos as $photo)
            <li class="large">
                <picture>
                    <source srcset="{{asset('storage/'.$photo->path('xl', 'webp'))}}" type="image/webp">
                    <source srcset="{{asset('storage/'.$photo->path('xl'))}}" type="image/jpeg">
                    <img src="{{asset('storage/'.$photo->path('xl'))}}">
                </picture>
            </li>
        @endforeach
    </ul>
@endsection
