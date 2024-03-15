@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
        <div class="container-fluid p-2">
            <project-view page-title="Özel Yazılım Projeleri" page-url="/project" id="{{$id}}"/>
        </div>
@endsection
