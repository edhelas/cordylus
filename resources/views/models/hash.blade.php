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

<div class="info">
    <p>Hello {{$model->name}}.<br /> Here are the selected pictures. They are not published yet.</p>
    <p>Please validate, or not, and comment the pictures that you want to publish.</p>

    @if ($shooting->comment)
        <p class="comment">Photograph comment</p>
        <p>{{$shooting->comment}}</p>
    @endif
</div>
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
