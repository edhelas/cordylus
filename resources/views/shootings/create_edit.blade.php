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
                <div class="form-check">
                    {!! Form::checkbox('hidden', null, $shooting->hidden, ['class' => 'form-check-input', 'id' =>'hidden']); !!}
                    {!! Form::label('hidden', 'Not listed in the galleries', ['class' => 'form-check-label']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>

    @if ($shooting->id)

        <hr />

        <h3>Videos</h3>

        <div class="row pl-2 pr-2">
            @foreach ($shooting->videos as $video)
                <div class="col-sm-4 p-0 card">
                    <div class="p-1">
                        <div class="btn-group" role="group">
                            <a href="{{ route($video->published ? 'shootings.videos.unpublish' : 'shootings.videos.publish', [$shooting, $video]) }}"
                                class="btn {{ $video->published ? 'btn-success' : 'btn-secondary' }} btn-sm">
                                {{ $video->published ? '✓' : '✗' }}
                            </a>
                            <a href="{{ route('shootings.videos.edit', [$shooting, $video]) }}" title="Edit" class="btn btn-warning btn-sm">✏️</a>
                        </div>
                        <div class="btn-group float-right" role="group">
                            <a href="{{ route($video->exclusive ? 'shootings.videos.unexclusive' : 'shootings.videos.exclusive', [$shooting, $video]) }}"
                                    class="btn {{ $video->exclusive ? 'btn-info' : 'btn-link' }} btn-sm">
                                {{ $video->exclusive ? 'Exclusive' : 'Exclusive' }}
                            </a>
                        </div>
                    </div>
                    <img class="card-img-top" src="{{asset($video->cover)}}" style="object-fit: cover;"/>
                    <div class="p-2">
                        <a target="_blank" href="{{ $video->preview_h264}}">Preview H264</a><br />
                        <a target="_blank" href="{{ $video->preview_webm}}">Preview WebM</a>       <br />
                        <a target="_blank" href="{{ $video->{'720_h264'} }}">720p H264</a><br />
                        <a target="_blank" href="{{ $video->{'720_webm'} }}">720p WebM</a>
                    </div>
                </div>
            @endforeach

            <div class="col-sm-4 p-1">
                <a href="{{ route('shootings.videos.create', $shooting) }}" class="btn btn-success btn-lg btn-block">Add</a>
            </div>
        </div>

        <hr />

        <a href="{{ route('shootings.photos.publish_all', $shooting) }}" title="Publish All" class="btn btn-success btn-sm float-right">
            Publish All
        </a>

        <h3 id="photos">Photos</h3>

        <div class="row pl-2 pr-2">
            @foreach ($shooting->photos as $photo)
                <div class="col-sm-4 p-0 card" id="{{$photo->id}}">
                    <div class="p-1">
                        <a href="{{ route($photo->published ? 'shootings.photos.unpublish' : 'shootings.photos.publish', [$shooting, $photo]) }}"
                            class="btn {{ $photo->published ? 'btn-success' : 'btn-secondary' }} btn-sm"
                            title="{{ $photo->published ? 'Published' : 'Unpublished' }}">
                            {{ $photo->published ? 'Publ. ✓' : 'Unp. ✗' }}
                        </a>
                        <div class="btn-group" role="group">
                            <a href="{{ route('shootings.photos.edit', [$shooting, $photo]) }}" title="Edit" class="btn btn-warning btn-sm">✏️</a>
                            <a href="{{ route('shootings.photos.remove', [$shooting, $photo]) }}" title="Delete" class="btn btn-danger btn-sm">🗑️</a>
                        </div>
                        <div class="btn-group" role="group">
                            @if ($photo->position > 0)
                                <a href="{{ route('shootings.photos.up', [$shooting, $photo]) }}" title="Move up" class="btn btn-sm"><</a>
                            @endif
                            @if ($photo->position < $shooting->photos()->count() - 1)
                                <a href="{{ route('shootings.photos.down', [$shooting, $photo]) }}" title="Move down" class="btn btn-sm">></a>
                            @endif
                        </div>
                        <div class="btn-group float-right" role="group">
                            <a href="{{ route('shootings.photos.primary', [$shooting, $photo]) }}" class="btn btn-sm
                                {{ ($shooting->primary_photo_id == $photo->id) ? 'btn-info' : 'btn-link' }}">
                                Main
                            </a>
                            <a href="{{ route($photo->exclusive ? 'shootings.photos.unexclusive' : 'shootings.photos.exclusive', [$shooting, $photo]) }}"
                                    class="btn {{ $photo->exclusive ? 'btn-info' : 'btn-link' }} btn-sm">
                                Exclusive
                            </a>
                        </div>
                    </div>
                    <a href="{{asset($photo->path('o'))}}" target="_blank">
                        <img class="card-img-top" src="{{asset($photo->path('l'))}}" style="object-fit: cover;"/>
                    </a>
                    @if($photo->models->count() > 0)
                    <div class="p-1">
                        <p class="text-center mb-0">
                            @foreach($photo->models as $m)
                                {{ $m->name }} {{ $m->pivot->validated? '✓' : '✗' }}
                                @if ($m->pivot->comment)
                                    ({{ $m->pivot->comment }})
                                @endif
                            @endforeach
                        </p>
                    </div>
                    @endif
                </div>
            @endforeach

            <div class="col-sm-4 p-1">
                <a href="{{ route('shootings.photos.create', $shooting) }}" class="btn btn-success btn-lg btn-block">Add</a>
            </div>
        </div>

        <hr />

        <h3>Models</h3>

        <div class="row pl-2 pr-2">
            @foreach ($shooting->models as $model)
                <div class="col-sm-3 p-1">
                    <div class="card">
                        <div class="p-2">
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

            <div class="col-sm-3 p-1">
                <div class="card">
                    <div class="p-2">
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

    @endif

@endsection