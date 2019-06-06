@extends('layouts.app')

@section('subtitle'){{$model->name}}@endsection

@section('subsubtitle')
<h3>
    @if ($model->instagram)
        <a href="https://www.instagram.com/{{$model->instagram}}" target="_blank">Instagram</a>
    @endif
    @if ($model->instagram && $model->website)-@endif
    @if ($model->website)
        <a href="{{$model->website}}" target="_blank">Website</a>
    @endif
<h3>
@endsection

@section('content')
    @include('partials.gallery', ['shootings' => $model->shootings])
@endsection
