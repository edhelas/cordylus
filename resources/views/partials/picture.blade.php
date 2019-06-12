<picture>
    <source srcset="{{asset('storage/'.$picture->path('xl', 'webp'))}}" type="image/webp">
    <source srcset="{{asset('storage/'.$picture->path('xl'))}}" type="image/jpeg">
    <img src="{{asset('storage/'.$picture->path('xl'))}}">
</picture>