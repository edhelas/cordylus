<ul class="gallery">
    @foreach ($shootings as $shooting)
        <li class="active" onclick="redirect('{{route('shootings.show.slug', $shooting->slug)}}')">
            @if ($shooting->photos()->where('published', true)->count() > 0)
                @include('partials.picture', ['picture' => $shooting->primary, 'gallery' => true])
            @endif
            <div class="label">
                <h1>{{ $shooting->name }}</h1>
                <span>
                    by
                    <a href="{{route('authors.show.slug', $shooting->author->slug)}}">{{ $shooting->author->name }}</a>
                    <br />
                    @if (!empty($shooting->with))
                        with {!! $shooting->with !!}
                    @endif
                </span>
            </div>
            <div class="description">
                {{ $shooting->photos()->where('published', true)->count() + $shooting->videos()->where('published', true)->count()}} medias
            </div>
        </li>
    @endforeach
</ul>