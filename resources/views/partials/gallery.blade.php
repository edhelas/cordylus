<ul class="gallery">
    @foreach ($shootings as $shooting)
        <li class="active" onclick="redirect('{{route('shootings.show.slug', $shooting->slug)}}')">
            @if ($shooting->photos()->count() > 0)
                @include('partials.picture', ['picture' => $shooting->primary])
            @endif
            <div class="label">
                <h1>{{ $shooting->name }}</h1>
                <span>
                    by
                    <a href="{{route('authors.show.slug', $shooting->author->slug)}}">{{ $shooting->author->name }}</a>
                </span>
                @if (!empty($shooting->with))
                    <span>with {!! $shooting->with !!}</span>
                @endif
            </div>
            <div class="description">
                {{ $shooting->photos()->count() + $shooting->videos()->count()}} medias
            </div>
        </li>
    @endforeach
</ul>