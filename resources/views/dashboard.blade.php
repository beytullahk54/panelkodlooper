@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid">
      <div class="row">
          <div class="col">
            <div class="card p-3">


              @if(Auth::User()->admin==1)
                <b> Hoşgeldiniz {{Auth::User()->name}}</b>
                <dashboard  page-title="Dashboard" page-url="dashboard"></dashboard>

              @else
                
                @if(Auth::User()->firma_id)
                      @if(Auth::User()->firma->firma_durum=='onaylandi')
                        <b>Hoşgeldiniz, {{Auth::User()->firma->firma_adi}}</b>
                        <dashboard-bayi page-title="Dashboard" page-url="dashboard"></dashboard-bayi>
                        @else
                          <b> Bayilik başvurunuz onay sürecindedir. Değerlendirme tamamlandığında tarafınıza ayrıca bilgi verilecektir. Başvurunuz onaylandığında panel menüsünün tamamını görüntüleyebileceksiniz.</b>
                        @endif
                @endif
              @endif

            </div>
          </div>
        </div>
    </div>
@endsection
