@extends('layouts.app')

@section('subtitle')Models@endsection

@section('content')
    <ul class="gallery">
        @foreach ($models as $model)
            <li class="active" onclick="redirect('{{route('models.show.slug', $model->slug)}}')">
                <div class="label">
                    {{ $model->name }}
                </div>
                @if ($model->primary)
                    @include('partials.picture', ['picture' => $model->primary, 'gallery' => true])
                @endif
            </li>
        @endforeach
    </ul>
@endsection
