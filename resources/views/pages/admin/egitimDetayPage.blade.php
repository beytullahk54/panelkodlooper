@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards') 
        <div class="container-fluid p-2">
            <egitim-detay page-title="Yeni Eğitim" page-url="egitim" id="{{$id}}"/>
        </div>
@endsection
