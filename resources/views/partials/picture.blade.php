<picture class="
    @if($picture->published)published @endif
    @if(!empty($caption))caption @endif
    ">
    <source
        srcset="
            @if(!empty($caption))
                {{asset($picture->path('xl', 'webp', true))}} 768w,
                {{asset($picture->path('l', 'webp', true))}} 512w,
                {{asset($picture->path('ml', 'webp', true))}} 256w,
                {{asset($picture->path('sl', 'webp', true))}} 128w
            @else
                @if(empty($gallery))
                    {{asset($picture->path('xxl', 'webp'))}} 1024w,
                @endif
                {{asset($picture->path('xl', 'webp'))}} 768w,
                {{asset($picture->path('l', 'webp'))}} 512w,
                {{asset($picture->path('ml', 'webp'))}} 256w,
                {{asset($picture->path('sl', 'webp'))}} 128w
            @endif
        "
        type="image/webp">
    <source
        srcset="
            @if(!empty($caption))
                {{asset($picture->path('xl', 'jpg', true))}} 768w,
                {{asset($picture->path('l', 'jpg', true))}} 512w,
                {{asset($picture->path('ml', 'jpg', true))}} 256w,
                {{asset($picture->path('sl', 'jpg', true))}} 128w
            @else
                @if(empty($gallery))
                    {{asset($picture->path('xxl', 'jpg'))}} 1024w,
                @endif
                {{asset($picture->path('xl', 'jpg'))}} 768w,
                {{asset($picture->path('l', 'jpg'))}} 512w,
                {{asset($picture->path('ml', 'jpg'))}} 256w,
                {{asset($picture->path('sl', 'jpg'))}} 128w
            @endif
        "
        type="image/jpg">
    <img
        loading="lazy"
        src="{{asset($picture->path('xl', 'jpg', !empty($caption)))}}"
    >
</picture>
