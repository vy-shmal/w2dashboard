@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard {{ Carbon\Carbon::parse(today())->format('d/m/Y ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card" style="width: 10rem; display: inline-block;">
                        <div class="card-body">
                            <h5 class="card-title">Σημερινές Παραγγελείες</h5>
                            <h3 class="card-text"> {{ $totalOrders }}</h3>
                        </div>
                    </div>

                    <div class="card" style="width: 10rem; display: inline-block;">
                        <div class="card-body">
                            <h5 class="card-title">Τζίρος χωρίς  Μεταφορικά</h5>
                            <h3 class="card-text"> {{ $tzirosNoShipping }} €</h3>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <ul>
                            @foreach ($paymentMethods as $key => $value )
                                    <li>
                                        {{$key}} : {{number_format($value['ammount'],'2')}} € : {{$value['count']}}
                                    </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
