@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <a href="{{ route('distance.index') }}" class="btn btn-primary">Distance</a>
                    <a href="{{ route('reliefCenters.index') }}" class="btn btn-primary">Relief Centers</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
