@extends('layouts.app')

@section('subtitle')Models @endsection

@section('content')
    <ul class="gallery">
        @foreach ($models as $model)
            @if ($model->primary)
                <li class="active" onclick="redirect('{{route('models.show.slug', $model->slug)}}')">
                    <div class="label">
                        {{ $model->name }}
                    </div>
                    @include('partials.picture', ['picture' => $model->primary, 'gallery' => true])
                </li>
            @endif
        @endforeach
    </ul>
@endsection
