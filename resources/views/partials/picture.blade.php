<picture>
    <source srcset="{{asset($picture->path('xl', 'webp'))}}" type="image/webp">
    <source srcset="{{asset($picture->path('xl'))}}" type="image/jpeg">
    <img src="{{asset($picture->path('xl'))}}">
</picture>