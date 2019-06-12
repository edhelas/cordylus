<ul class="gallery">
    @foreach ($shootings as $shooting)
        <li class="active" onclick="redirect('{{route('shootings.show.slug', $shooting->slug)}}')">
            @if ($shooting->photos()->count() > 0)
                @include('partials.picture', ['picture' => $shooting->primary])
            @endif
            <div class="label">
                <h1>{{ $shooting->name }}</h1>
                @if (!empty($shooting->with))
                    <span>with {!! $shooting->with !!}</span>
                @endif
            </div>
        </li>
    @endforeach
</ul>