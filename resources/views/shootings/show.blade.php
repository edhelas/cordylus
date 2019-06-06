@extends('layouts.app')

@section('subtitle'){{$shooting->name}}@endsection

@section('subsubtitle')
<h3>
    {{$shooting->date->format('M j, Y')}}
     @if (!empty($shooting->with))
    with {!! $shooting->with !!}
    - {{$shooting->photos->count()}} photos
@endif
<h3>
@endsection

@section('content')
    <ul class="gallery">
        @foreach ($shooting->photos as $photo)
            <li class="large">
                <img src="{{asset('storage/'.$photo->path('xl'))}}"/>
            </li>
        @endforeach
    </ul>
@endsection
