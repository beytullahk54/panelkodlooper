@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
        <div class="container-fluid p-2">
            <destek-detay detay-id="{{$id}}" page-title="Destek" page-url="destek"/>
        </div>
@endsection
