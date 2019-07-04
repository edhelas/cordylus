<video class="@if(!empty($caption))caption @endif"
    controls poster="{{asset($video->cover)}}">
    @if(!empty($caption) || $video->{'720_h264'} == null || $video->{'720_webm'} == null)
        <source src="{{$video->preview_h264}}" type="video/webm">
        <source src="{{$video->preview_webm}}" type="video/mp4">
    @else
        <source src="{{$video->{'720_h264'} }}" type="video/webm">
        <source src="{{$video->{'720_webm'} }}" type="video/mp4">
    @endif
    Video formats not supported
</video>