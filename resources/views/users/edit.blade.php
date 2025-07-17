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

        <div class="row">
            {!! Form::label('name', 'Name', ['class' => 'col-md-4 col-form-label text-md-end']) !!}
            <div class="col-md-6">
                {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>

        <div class="row">
            {!! Form::label('slug', 'Slug', ['class' => 'col-md-4 col-form-label text-md-end']) !!}
            <div class="col-md-6">
                {!! Form::text('slug', $user->slug, ['class' => 'form-control', 'required']); !!}
            </div>
        </div>

        <div class="row">
            {!! Form::label('instagram', 'Instagram nickname', ['class' => 'col-md-4 col-form-label text-md-end']) !!}
            <div class="col-md-6">
                {!! Form::text('instagram', $user->instagram, ['class' => 'form-control', 'placeholder' => 'mynickname']); !!}
            </div>
        </div>

        <div class="row">
            {!! Form::label('twitter', 'Twitter', ['class' => 'col-md-4 col-form-label text-md-end']) !!}
            <div class="col-md-6">
                {!! Form::text('twitter', $user->twitter, ['class' => 'form-control', 'placeholder' => 'mynickname']); !!}
            </div>
        </div>

        <div class="row">
            {!! Form::label('patreon', 'Patreon', ['class' => 'col-md-4 col-form-label text-md-end']) !!}
            <div class="col-md-6">
                {!! Form::text('patreon', $user->patreon, ['class' => 'form-control', 'placeholder' => 'PatreonChannel']); !!}
            </div>
        </div>

        <div class="row">
            {!! Form::label('website', 'Website URL', ['class' => 'col-md-4 col-form-label text-md-end']) !!}
            <div class="col-md-6">
                {!! Form::url('website', $user->website, ['class' => 'form-control', 'placeholder' => 'https://website.com']); !!}
            </div>
        </div>

        <div class="row">
            {!! Form::label('description', 'Description', ['class' => 'col-md-4 col-form-label text-md-end']) !!}
            <div class="col-md-6">
                {!! Form::textarea('description', $user->description, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'A small description']); !!}
            </div>
        </div>

        <div class="col-md-8 offset-md-4">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']); !!}
        </div>

    </form>
@endsection
