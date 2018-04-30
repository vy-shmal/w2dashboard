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

                    <div class="card" style="width: 10rem;">
                        <div class="card-body">
                            <h5 class="card-title">Σημερινές Παραγγελείες</h5>
                            {{--<h3 class="card-text"> {{ count($orders )}}</h3>--}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
