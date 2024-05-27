@extends('layouts.app')

@section('subtitle'){{$shooting->name}}

@if($exclusive)
+ Exclusive content
@endif
@endsection

@section('subsubtitle')
<h3>
    {!! $shooting->description !!}
</h3>
@endsection

@section('content')
    <ul class="gallery">
        @foreach ($shooting->videos()->where('published', true)->get() as $video)
            <li>
                @if ($video->exclusive && !$exclusive)
                    @include('partials.video', ['video' => $video, 'caption' => true])
                @else
                    @include('partials.video', ['video' => $video, 'caption' => false])
                @endif
            </li>
        @endforeach

        @foreach ($shooting->photos()->where('published', true)->get() as $photo)
            <li>
                @if ($photo->exclusive && !$exclusive)
                    @include('partials.picture', ['picture' => $photo, 'caption' => true])
                @else
                    @include('partials.picture', ['picture' => $photo, 'caption' => false])
                @endif
            </li>
        @endforeach
    </ul>
@endsection
