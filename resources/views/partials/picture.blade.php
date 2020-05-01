<picture class="
    @if($picture->published)published @endif
    @if(!empty($caption))caption @endif
    ">
    <source
        srcset="
            @if(!empty($caption))
                {{asset($picture->path('xl', 'webp', true))}} 1024w,
                {{asset($picture->path('l', 'webp', true))}} 768w,
                {{asset($picture->path('ml', 'webp', true))}} 512w,
                {{asset($picture->path('sl', 'webp', true))}} 256w
            @else
                @if(empty($gallery))
                    {{asset($picture->path('xxl', 'webp'))}} 1536w,
                @endif
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
                {{asset($picture->path('xl', 'jpg', true))}} 1024w,
                {{asset($picture->path('l', 'jpg', true))}} 768w,
                {{asset($picture->path('ml', 'jpg', true))}} 512w,
                {{asset($picture->path('sl', 'jpg', true))}} 256w
            @else
                @if(empty($gallery))
                    {{asset($picture->path('xxl'))}} 1536w,
                @endif
                {{asset($picture->path('xl'))}} 1024w,
                {{asset($picture->path('l'))}} 768w,
                {{asset($picture->path('ml'))}} 512w,
                {{asset($picture->path('sl'))}} 256w
            @endif
        "
        src="{{asset($picture->path('xl', 'jpg', !empty($caption)))}}"
    >
</picture>
