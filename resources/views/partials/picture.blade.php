<picture class="
    @if($picture->published)published @endif
    @if(!empty($caption))caption @endif
    ">
    <source
        srcset="
            @if(!empty($caption))
                {{asset($picture->path('blurred', 'webp'))}}
            @else
                {{asset($picture->path('xxl', 'webp'))}} 1920w,
                {{asset($picture->path('xl', 'webp'))}} 1536w,
                {{asset($picture->path('l', 'webp'))}} 1024w,
                {{asset($picture->path('ml', 'webp'))}} 768w,
                {{asset($picture->path('sl', 'webp'))}} 512w
            @endif
        "
        type="image/webp">
    <img
        srcset="
            @if(!empty($caption))
                {{asset($picture->path('blurred'))}}
            @else
            {{asset($picture->path('xxl'))}} 1920w,
            {{asset($picture->path('xl'))}} 1536w,
            {{asset($picture->path('l'))}} 1024w,
            {{asset($picture->path('ml'))}} 768w,
            {{asset($picture->path('sl'))}} 512w
            @endif
        "
        src="{{asset($picture->path(!empty($caption) ? 'blurred' : 'xl'))}}"
    >
</picture>