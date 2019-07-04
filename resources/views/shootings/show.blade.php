@extends('layouts.app')

@section('subtitle'){{$shooting->name}}

@if($exclusive)
+ Exclusive content
@endif
@endsection

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
        @foreach ($shooting->videos()->where('published', true)->get() as $video)
            <li class="large">
                @if ($video->exclusive && !$exclusive)
                    @include('partials.video', ['video' => $video, 'caption' => true])
                @else
                    @include('partials.video', ['video' => $video, 'caption' => false])
                @endif
            </li>
        @endforeach

        @foreach ($shooting->photos()->where('published', true)->get() as $photo)
            <li class="large">
                @if ($photo->exclusive && !$exclusive)
                    @include('partials.picture', ['picture' => $photo, 'caption' => true])
                @else
                    @include('partials.picture', ['picture' => $photo, 'caption' => false])
                @endif
            </li>
        @endforeach
    </ul>
@endsection
