<ul class="gallery">
    @foreach ($shootings as $shooting)
        <li>
            @if ($shooting->photos()->count() > 0)
                <img src="{{asset('storage/'.$shooting->photos()->first()->path('xl'))}}"/>
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