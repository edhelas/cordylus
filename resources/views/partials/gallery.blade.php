<ul class="gallery">
    @foreach ($shootings as $shooting)
        <li class="active" onclick="redirect('{{route('shootings.show.slug', $shooting->slug)}}')">
            <div class="label">
                {{ $shooting->name }}
                    @if (!empty($shooting->with))
                        with {!! $shooting->with !!}
                    @endif
            </div>
            @if ($shooting->photos()->where('published', true)->count() > 0)
                @include('partials.picture', ['picture' => $shooting->primary, 'gallery' => true])
            @endif
        </li>
    @endforeach
</ul>