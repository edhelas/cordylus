<picture class="
    @if($picture->published)published @endif
    @if(!empty($caption))caption @endif
    ">
    <source srcset="{{asset($picture->path(!empty($caption) ? 's' : 'xl', 'webp'))}}" type="image/webp">
    <source srcset="{{asset($picture->path(!empty($caption) ? 's' : 'xl'))}}" type="image/jpeg">
    <img src="{{asset($picture->path(!empty($caption) ? 's' : 'xl'))}}">
</picture>