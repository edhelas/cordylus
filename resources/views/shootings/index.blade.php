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
                {{$shooting->date}}<br />
                <a href="{{ route('shootings.edit', $shooting) }}" class="btn btn-warning btn-sm">Edit</a>
            </th>
            <td>
                @foreach ($shooting->models as $model)
                    {{$model->name}}
                    <a href="{{ route('shootings.models.remove', [$shooting, $model]) }}" class="btn btn-danger btn-sm">x</a><br />
                @endforeach
                {!! Form::open(['route' => ['shootings.models.add', $shooting->id]]) !!}

                    {!! Form::select(
                        'model_id',
                        $models->whereNotIn('id', $shooting->models->pluck('id'))
                               ->pluck('name', 'id'),
                        null,
                        ['class' => 'form-control form-control-sm']);
                    !!}
                    {!! Form::submit('+', ['class' => 'btn btn-success btn-sm']); !!}

                {!! Form::close() !!}
            </td>
            <td>
                @foreach ($shooting->photos as $photo)
                    <img src="{{asset('storage/'.$photo->path('s'))}}"/>
                    <a href="{{ route('shootings.photos.remove', [$shooting, $photo]) }}" class="btn btn-danger btn-sm">x</a>
                @endforeach
                <a href="{{ route('shootings.photos.create', $shooting) }}" class="btn btn-success btn-sm">Add</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
