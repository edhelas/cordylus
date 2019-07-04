@extends('layouts.admin')

@section('content')
    @if($video->id)
        <h2>Edit</h2>
    @else
        <h2>Add a video to the shooting</h2>
    @endif

    {!! Form::model($video, [
        'action' => $video->id
            ? ['Admin\ShootingVideoController@update', $video->shooting_id, $video->id]
            : ['Admin\ShootingVideoController@store', $video->shooting_id],
        'method' => $video->id
            ? 'put'
            : 'post',
        'files'=>'true'
    ]) !!}

        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('preview_h264', 'Preview H264 *') !!}
                {!! Form::url('preview_h264', $video->preview_h264, ['class' => 'form-control', 'required']); !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('preview_webm', 'Preview WebM *') !!}
                {!! Form::url('preview_webm', $video->preview_webm, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('720_h264', '720p H264') !!}
                {!! Form::url('720_h264', $video->{'720_h264'}, ['class' => 'form-control', 'required']); !!}
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('720_webm', '720p WebM') !!}
                {!! Form::url('720_webm', $video->{'720_webm'}, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="form-group col-md-4">
                {!! Form::label('cover', 'Cover *') !!}
                {!! Form::file('cover', ['class' => 'form-control', $video->id ?? 'required', '']); !!}
            </div>
            <div class="form-group col-md-4">
                @if ($video->cover)
                    <p>Current cover</p>
                    <img src="{{asset($video->cover)}}" style="max-width: 200px"/>
                @endif
            </div>
        </div>


        {!! Form::hidden('shooting_id', $video->shooting_id) !!}

        {!! Form::submit($video->id ? 'Save' :'Create', ['class' => 'btn btn-primary']); !!}

    {!! Form::close() !!}
@endsection
