@extends('layouts.admin')

@section('content')
<a href="{{ route('shootings.create') }}" class="btn btn-success float-right">Create</a>
<h1>Shootings <small class="text-muted h5">{{$shootings->count()}}</small></h1>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Models</th>
            <th>Photos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shootings as $shooting)
        <tr>
            <th>
                {{$shooting->name}}<br />
                {{$shooting->date->format('M j, Y')}}<br />
                <a href="{{ route('shootings.edit', $shooting) }}" class="btn btn-warning btn-sm">Edit</a>
            </th>
            <td>
                {{$shooting->models->implode('name', ', ')}}
            </td>
            <td>
                @foreach ($shooting->photos as $photo)
                    <img src="{{asset('storage/'.$photo->path('s'))}}"/>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
