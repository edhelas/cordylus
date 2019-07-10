<picture class="
    @if($picture->published)published @endif
    @if(!empty($caption))caption @endif
    ">
    <source
        srcset="
            @if(!empty($caption))
                {{asset($picture->path('blurred', 'webp'))}}
            @else
                {{asset($picture->path('xxl', 'webp'))}} 1536w,
                {{asset($picture->path('xl', 'webp'))}} 1024w,
                {{asset($picture->path('l', 'webp'))}} 768w,
                {{asset($picture->path('ml', 'webp'))}} 512w,
                {{asset($picture->path('sl', 'webp'))}} 256w
            @endif
        "
        type="image/webp">
    <img
        srcset="
            @if(!empty($caption))
                {{asset($picture->path('blurred'))}}
            @else
            {{asset($picture->path('xxl'))}} 1536w,
            {{asset($picture->path('xl'))}} 1024w,
            {{asset($picture->path('l'))}} 768w,
            {{asset($picture->path('ml'))}} 512w,
            {{asset($picture->path('sl'))}} 256w
            @endif
        "
        src="{{asset($picture->path(!empty($caption) ? 'blurred' : 'xl'))}}"
    >
</picture>