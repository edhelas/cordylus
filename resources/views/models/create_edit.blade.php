@extends('layouts.admin')

@section('content')
    <div class="col-md-8 offset-md-4">
        @if($model->id)
            <h2>Edit a model</h2>
        @else
            <h2>Create a model</h2>
        @endif
    </div>

    {!! Form::model($model, [
        'action' => $model->id
            ? ['Admin\ModelController@update', $model->id]
            : 'Admin\ModelController@store',
        'method' => $model->id
            ? 'put'
            : 'post',
        'class' => 'col-md-12'
    ]) !!}

        <div class="form-group row">
            {!! Form::label('name', 'Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::text('name', $model->name, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('slug', 'Slug', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::text('slug', $model->slug, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('instagram', 'Instagram', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::text('instagram', $model->instagram, ['class' => 'form-control']); !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('website', 'Website', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::url('website', $model->website, ['class' => 'form-control']); !!}
            </div>
        </div>

        <div class="col-md-8 offset-md-4">
        {!! Form::submit($model->id ? 'Save' :'Create', ['class' => 'btn btn-primary']); !!}
        </div>

    {!! Form::close() !!}
@endsection
