@extends('layouts.admin')

@section('content')
    @if($shooting->id)
        <h2>Edit </h2>
    @else
        <h2>Create</h2>
    @endif

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
                        {!! Form::checkbox('published', null, $shooting->published, ['class' => 'form-check-input']); !!}
                        {!! Form::label('published', 'Published', ['class' => 'form-check-label']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>

    <hr />

    <h3>Photos</h3>

    <div class="row">
        @foreach ($shooting->photos as $photo)
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-center">
                        <img src="{{asset('storage/'.$photo->path('m'))}}" style="max-width: 100%"/>
                        </p>

                        <p class="text-center mb-0">
                            <a href="{{ route('shootings.photos.primary', [$shooting, $photo]) }}" class="btn btn-info btn-sm
                            @if ($shooting->primary_photo_id == $photo->id)
                                disabled
                            @endif
                            ">Primary
                            </a>
                            <a href="{{ route('shootings.photos.remove', [$shooting, $photo]) }}" class="btn btn-danger btn-sm">Delete</a>
                        </p>
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
                        <input type="text" readonly value="{{$model->pivot->hash}}" class="form-control form-control-sm"/>
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