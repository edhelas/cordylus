<picture class="
    @if($picture->published)published @endif
    @if(!empty($caption))caption @endif
    ">
    <source srcset="
            @if(!empty($caption))
                {{asset($picture->path('xl', 'webp', true))}} 768w,
                {{asset($picture->path('l', 'webp', true))}} 512w
            @else
                @if(empty($gallery))
                    {{asset($picture->path('xxl', 'webp'))}} 1024w,
                @endif
                {{asset($picture->path('xl', 'webp'))}} 768w,
                {{asset($picture->path('l', 'webp'))}} 512w
            @endif
        " type="image/webp">
    <source srcset="
            @if(!empty($caption))
                {{asset($picture->path('xl', 'jpg', true))}} 768w,
                {{asset($picture->path('l', 'jpg', true))}} 512w
            @else
                @if(empty($gallery))
                    {{asset($picture->path('xxl', 'jpg'))}} 1024w,
                @endif
                {{asset($picture->path('xl', 'jpg'))}} 768w,
                {{asset($picture->path('l', 'jpg'))}} 512w
            @endif
        " type="image/jpg">
    <img loading="lazy" src="{{asset($picture->path('xl', 'jpg', !empty($caption)))}}">
</picture>