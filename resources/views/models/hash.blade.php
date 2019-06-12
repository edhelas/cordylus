@extends('layouts.app')

@section('subtitle'){{$shooting->name}} [Pre-Publication]@endsection

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
    <p>Hello {{$model->name}}. Here are the selected pictures waiting for your approval.</p>
    <p>You can also add a comment if you have one.</p>

    @if ($shooting->comment)
        <p class="comment">Photograph comment</p>
        <p>{{$shooting->comment}}</p>
    @endif
</div>
@endsection

@section('content')
    <ul class="gallery">
        @foreach ($shooting->photos as $key => $photo)
            <li class="large">
                @include('partials.picture', ['picture' => $photo])

                {!! Form::open(['route' => ['models.photos.create', $hash], 'class' => 'opinion', 'id' => $photo->id]) !!}
                    <span class="num">n°{{$key+1}}</span>
                    {!! Form::checkbox('validated', null, $photo->model($model->id)
                        ? $photo->model($model->id)->pivot->validated
                        : null, ['id' => 'validated_'.$photo->id]); !!}

                    {{ $model->name }} {!! Form::label('validated_'.$photo->id, ' ') !!}

                    @foreach($photo->models()->where('id', '!=', $model->id)->get() as $m)
                        - {{ $m->name }} {{ $m->pivot->validated? '✓' : '✗' }}
                    @endforeach

                    {!! Form::hidden('photo_id', $photo->id) !!}

                    <div>
                        {!! Form::textarea('comment', $photo->model($model->id)
                            ? $photo->model($model->id)->pivot->comment
                            : '', ['rows' => 2, 'placeholder' => 'Add a comment if you have one']); !!}
                    </div>
                    <div>
                        {!! Form::submit('Save', ['class' => '']); !!}
                    </div>
                {!! Form::close() !!}
            </li>
        @endforeach
    </ul>
@endsection
