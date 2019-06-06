@extends('layouts.admin')

@section('content')
    @if($model->id)
        <h2>Edit</h2>
    @else
        <h2>Create</h2>
    @endif

    {!! Form::model($model, [
        'action' => $model->id
            ? ['Admin\ModelController@update', $model->id]
            : 'Admin\ModelController@store',
        'method' => $model->id
            ? 'put'
            : 'post'
    ]) !!}

        <div class="form-group row">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $model->name, ['class' => 'form-control', 'required']); !!}
        </div>

        <div class="form-group row">
            {!! Form::label('slug', 'Slug') !!}
            {!! Form::text('slug', $model->slug, ['class' => 'form-control', 'required']); !!}
        </div>

        <div class="form-group row">
                {!! Form::label('instagram', 'Instagram') !!}
                {!! Form::text('instagram', $model->instagram, ['class' => 'form-control']); !!}
        </div>

        <div class="form-group row">
                {!! Form::label('website', 'Website') !!}
                {!! Form::url('website', $model->website, ['class' => 'form-control']); !!}
        </div>

        {!! Form::submit($model->id ? 'Save' :'Create', ['class' => 'btn btn-primary']); !!}

    {!! Form::close() !!}
@endsection
