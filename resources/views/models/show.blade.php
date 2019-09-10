@extends('layouts.app')

@section('subtitle'){{$model->name}}@endsection

@section('subsubtitle')
<h4 class="links">
    @if ($model->instagram)
        <a href="https://www.instagram.com/{{$model->instagram}}" target="_blank">Instagram</a>
    @endif
    @if ($model->website)
        <a href="{{$model->website}}" target="_blank">Website</a>
    @endif
    @if ($model->patreon)
        <a href="https://www.patreon.com/{{$model->patreon}}" target="_blank">Patreon</a>
    @endif
    @if ($model->twitter)
        <a href="https://twitter.com/{{$model->twitter}}" target="_blank">Twitter</a>
    @endif
</h4>
@endsection

@section('content')
    @include('partials.gallery', ['shootings' => $model->shootings()->notHidden()->published()->get()])
@endsection
