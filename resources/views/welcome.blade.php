@extends('layouts.app')

@section('content')
    @include('partials.gallery', ['shootings' => $shootings])
@endsection
