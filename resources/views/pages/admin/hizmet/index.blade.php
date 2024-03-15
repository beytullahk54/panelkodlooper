@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
        <div class="container-fluid p-2">
            <hizmet page-title="Markalar" hizmet="{{$hizmet}}" page-url="/admin/hizmetler"/>
        </div>
@endsection
