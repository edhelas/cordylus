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
        @foreach ($shooting->photos()->where('published', true)->get() as $photo)
            <li class="large">
                @include('partials.picture', ['picture' => $photo])
            </li>
        @endforeach
    </ul>
@endsection
