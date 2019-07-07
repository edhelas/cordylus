@extends('layouts.admin')

@section('content')

    <div class="col-md-8 offset-md-4">
        <h2>Edit my profile</h2>
    </div>

    {!! Form::model($user, [
        'action' => ['Admin\UserController@update'],
        'method' => 'put',
        'class' => 'col-md-12'
    ]) !!}

        <div class="form-group row">
            {!! Form::label('name', 'Name', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('slug', 'Slug', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::text('slug', $user->slug, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('instagram', 'Instagram nickname', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::text('instagram', $user->instagram, ['class' => 'form-control', 'placeholder' => 'mynickname']); !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('website', 'Website URL', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
            <div class="col-md-6">
                {!! Form::url('website', $user->website, ['class' => 'form-control', 'placeholder' => 'https://website.com']); !!}
            </div>
        </div>

        <div class="col-md-8 offset-md-4">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']); !!}
        </div>

    {!! Form::close() !!}
@endsection
