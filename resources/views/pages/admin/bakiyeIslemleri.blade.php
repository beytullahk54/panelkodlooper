@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
        <div class="container-fluid p-2">
            <bakiye-islemleri page-title="Bakiye İşlemleri" page-url="bakiye-hareketleri"/>
        </div>
@endsection
