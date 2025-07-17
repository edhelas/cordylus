@extends('layouts.admin')

@section('content')
<a href="{{ route('shootings.create') }}" class="btn btn-success float-end">Create</a>
<h1>Shootings <small class="text-muted h5">{{$shootings->count()}}</small></h1>

<div class="row g-2">
    @foreach ($shootings as $shooting)
        <div class="col-sm-4">
            <div class="card p-0">
                <img class="card-img-top" src="{{asset($shooting->primary->path('l'))}}" style="object-fit: cover;"/>
                <div class="card-body">
                    <h5 class="card-title">
                        {{$shooting->name}}
                        @if ($shooting->published)
                            <span class="badge badge-success">Published</span>
                        @endif
                        @if ($shooting->isMine())
                            <a href="{{ route('shootings.edit', $shooting) }}" class="btn btn-info float-end">Edit</a>
                        @endif
                    </h5>
                    <p class="card-text">by {{$shooting->author->name}} with {{$shooting->models->implode('name', ', ')}}
                    <p class="card-text"><small class="text-muted">{{$shooting->photos()->count()}} photos</small></p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection