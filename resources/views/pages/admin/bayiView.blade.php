@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
        <div class="container-fluid p-2">
            <bayi-view page-title="Bayiler" page-url="bayi" id="{{$id}}"/>
        </div>
@endsection
