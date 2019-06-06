@extends('layouts.admin')

@section('content')
<a href="{{ route('models.create') }}" class="btn btn-success float-right">Create</a>
<h1>Models <small class="text-muted h5">{{$models->count()}}</small></h1>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Instagram</th>
            <th>Website</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($models as $model)
        <tr>
            <th scope="row">{{$model->name}}</th>
            <td>
                <a href="https://www.instagram.com/{{$model->instagram}}">{{$model->instagram}}</a>
            </td>
            <td>
                <a href="{{$model->website}}">{{$model->website}}</a>
            </td>
            <td>
                <a href="{{ route('models.edit', $model) }}" class="btn btn-warning btn-sm float-right">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
