@extends('layouts.app')

@section('subtitle'){{$model->name}}@endsection

@section('content')
    @include('partials.gallery', ['shootings' => $model->shootings])
@endsection
