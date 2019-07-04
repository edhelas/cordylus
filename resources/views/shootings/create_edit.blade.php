@extends('layouts.admin')

@section('content')
    <div class="form-row">
        <div class="form-group col-md-6">
            @if($shooting->id)
                <h2>Edit
                    @if ($shooting->published)
                        <span class="badge badge-success">Published</span>
                    @endif
                </h2>
            @else
                <h2>Create</h2>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label>Exclusive link</label>
            <input type="text" readonly value="{{route('shootings.show.slug', [$shooting->slug, $shooting->exclusive_hash])}}" class="form-control form-control-sm"/>
        </div>
    </div>

    <div class="clearfix pb-1">
        {!! Form::model($shooting, [
            'action' => $shooting->id
                ? ['Admin\ShootingController@update', $shooting->id]
                : 'Admin\ShootingController@store',
            'method' => $shooting->id
                ? 'put'
                : 'post'
        ]) !!}
        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', $shooting->name, ['class' => 'form-control', 'required']); !!}
            </div>

            <div class="form-group col-md-3">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', $shooting->slug, ['class' => 'form-control', 'required']); !!}
            </div>
            <div class="form-group col-md-3">
                    {!! Form::label('location', 'Location') !!}
                    {!! Form::text('location', $shooting->location, ['class' => 'form-control']); !!}
            </div>

            <div class="form-group col-md-2">
                {!! Form::label('date', 'Shooting date') !!}
                {!! Form::date('date', $shooting->date, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                {!! Form::label('comment', 'Private comment') !!}
                {!! Form::textarea('comment', $shooting->comment, ['class' => 'form-control', 'rows' => 2]); !!}
            </div>
        </div>

        {!! Form::submit($shooting->id ? 'Save' :'Create', ['class' => 'btn btn-primary float-right']); !!}
        <div class="form-group col-md-4">
                <div class="form-check">
                        {!! Form::checkbox('published', null, $shooting->published, ['class' => 'form-check-input', 'id' =>'published']); !!}
                        {!! Form::label('published', 'Published', ['class' => 'form-check-label']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>

    <hr />

    <h3>Videos</h3>

    <div class="row">
        @foreach ($shooting->videos as $video)
            <div class="col-sm-3">
                <div class="card">
                    <img class="card-img-top" src="{{asset($video->cover)}}" style="object-fit: cover;"/>
                    <div class="card-body">
                        <a target="_blank" href="{{ $video->preview_h264}}">Preview H264</a><br />
                        <a target="_blank" href="{{ $video->preview_webm}}">Preview WebM</a>       <br />
                        <a target="_blank" href="{{ $video->{'720_h264'} }}">720p H264</a><br />
                        <a target="_blank" href="{{ $video->{'720_webm'} }}">720p WebM</a>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route($video->published ? 'shootings.videos.unpublish' : 'shootings.videos.publish', [$shooting, $video]) }}"
                            class="btn {{ $video->published ? 'btn-primary' : 'btn-secondary' }} btn-sm">
                            {{ $video->published ? 'Published' : 'Unpublished' }}
                        </a>
                        <a href="{{ route($video->exclusive ? 'shootings.videos.unexclusive' : 'shootings.videos.exclusive', [$shooting, $video]) }}"
                                class="btn {{ $video->exclusive ? 'btn-info' : 'btn-secondary' }} btn-sm">
                            {{ $video->exclusive ? 'Exclusive' : 'Not Exclusive' }}
                        </a>
                        <a href="{{ route('shootings.videos.edit', [$shooting, $video]) }}" class="btn btn-warning btn-sm">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <p class="text-center">
                        <a href="{{ route('shootings.videos.create', $shooting) }}" class="btn btn-success btn-lg btn-block">Add</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <hr />

    <h3>Photos</h3>

    <div class="row">
        @foreach ($shooting->photos as $photo)
            <div class="col-sm-3">
                <div class="card">
                    <a href="{{asset($photo->path('o'))}}" target="_blank">
                        <img class="card-img-top" src="{{asset($photo->path('l'))}}" style="object-fit: cover;"/>
                    </a>
                    @if($photo->models->count() > 0)
                    <div class="card-body">
                        <p class="text-center mb-1">
                            @foreach($photo->models as $m)
                                {{ $m->name }} {{ $m->pivot->validated? '✓' : '✗' }}
                                @if ($m->pivot->comment)
                                    ({{ $m->pivot->comment }})
                                @endif
                            @endforeach
                        </p>
                    </div>
                    @endif
                    <div class="card-footer">
                        <a href="{{ route($photo->published ? 'shootings.photos.unpublish' : 'shootings.photos.publish', [$shooting, $photo]) }}"
                            class="btn {{ $photo->published ? 'btn-primary' : 'btn-secondary' }} btn-sm">
                            {{ $photo->published ? 'Published' : 'Unpublished' }}
                        </a>
                        <a href="{{ route($photo->exclusive ? 'shootings.photos.unexclusive' : 'shootings.photos.exclusive', [$shooting, $photo]) }}"
                                class="btn {{ $photo->exclusive ? 'btn-info' : 'btn-secondary' }} btn-sm">
                            {{ $photo->exclusive ? 'Exclusive' : 'Not Exclusive' }}
                        </a>
                        <a href="{{ route('shootings.photos.primary', [$shooting, $photo]) }}" class="btn btn-info btn-sm
                        @if ($shooting->primary_photo_id == $photo->id)
                            disabled
                        @endif
                        ">Primary
                        </a>
                        <a href="{{ route('shootings.photos.edit', [$shooting, $photo]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('shootings.photos.remove', [$shooting, $photo]) }}" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <p class="text-center">
                        <a href="{{ route('shootings.photos.create', $shooting) }}" class="btn btn-success btn-lg btn-block">Add</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <hr />

    <h3>Models</h3>

    <div class="row">
        @foreach ($shooting->models as $model)
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('shootings.models.remove', [$shooting, $model]) }}" class="btn btn-danger btn-sm float-right">X</a>
                        <h5 class="card-title">{{$model->name}}</h5>
                        <p class="card-text form-group">
                            <a href="{{route('shooting.model.show.hash', $model->pivot->hash)}}">{{$model->pivot->hash}}</a>
                            <input type="text" readonly value="{{route('shooting.model.show.hash', $model->pivot->hash)}}" class="form-control form-control-sm"/>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => ['shootings.models.add', $shooting->id]]) !!}
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            {!! Form::select(
                                'model_id',
                                $models->whereNotIn('id', $shooting->models->pluck('id'))
                                    ->pluck('name', 'id'),
                                null,
                                ['class' => 'form-control form-control-sm']);
                            !!}
                        </div>
                        <div class="form-group col-md-2">
                        {!! Form::submit('+', ['class' => 'btn btn-success btn-sm']); !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection