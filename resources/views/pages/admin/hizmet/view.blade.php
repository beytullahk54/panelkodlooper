@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
        <div class="container-fluid p-2">
            <hizmet-view page-title="Özel Yazılım Projeleri" page-url="/admin/hizmetler" id="{{$id}}"/>
        </div>
@endsection
