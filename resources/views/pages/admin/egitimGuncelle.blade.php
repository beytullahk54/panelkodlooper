@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
        <div class="container-fluid p-2">
            <egitim-guncelle id="{{$id}}" page-title="Eğitim Güncelle" page-url="egitim"/>
        </div>
@endsection
