@extends('layouts.admin')

@section('content')
    @if($photo->id)
        <h2>Edit</h2>
    @else
        <h2>Add a photo to the shooting</h2>
    @endif

    {!! Form::model($photo, [
        'action' => $photo->id
            ? ['Admin\ShootingPhotoController@update', [$photo->shooting_id, $photo->id]]
            : ['Admin\ShootingPhotoController@store', $photo->shooting_id],
        'method' => $photo->id
            ? 'put'
            : 'post',
        'files'=>'true'
    ]) !!}

        <div class="form-group row">
            {!! Form::file('photo', $photo->file, ['class' => 'form-control', 'required']); !!}
        </div>

        {!! Form::hidden('shooting_id', $photo->shooting_id) !!}

        {!! Form::submit($photo->id ? 'Save' :'Create', ['class' => 'btn btn-primary']); !!}

    {!! Form::close() !!}
@endsection
