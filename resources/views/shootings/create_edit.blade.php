@extends('layouts.admin')

@section('content')
    @if($shooting->id)
        <h2>Edit</h2>
    @else
        <h2>Create</h2>
    @endif

    {!! Form::model($shooting, [
        'action' => $shooting->id
            ? ['Admin\ShootingController@update', $shooting->id]
            : 'Admin\ShootingController@store',
        'method' => $shooting->id
            ? 'put'
            : 'post'
    ]) !!}

        <div class="form-group row">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $shooting->name, ['class' => 'form-control', 'required']); !!}
        </div>

        <div class="form-group row">
            {!! Form::label('slug', 'Slug') !!}
            {!! Form::text('slug', $shooting->slug, ['class' => 'form-control', 'required']); !!}
        </div>

        <div class="form-group row">
                {!! Form::label('location', 'Location') !!}
                {!! Form::text('location', $shooting->location, ['class' => 'form-control']); !!}
        </div>

        <div class="form-group row">
            {!! Form::label('date', 'Shooting date') !!}
            {!! Form::date('date', $shooting->date, ['class' => 'form-control', 'required']); !!}
        </div>

        {!! Form::submit($shooting->id ? 'Save' :'Create', ['class' => 'btn btn-primary']); !!}

    {!! Form::close() !!}
@endsection
