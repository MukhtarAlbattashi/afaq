@extends('layouts.public')

@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-4">
                <div class="card text-center p-2 rounded">
                    <h2 class="text-primary">
                        Admin Page
                    </h2>
                    <img class="img-fluid mx-auto d-block" height="80" width="80"
                         src="{{ asset('images/class.png') }}" alt="">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{route('login')}}" rel="noopener noreferrer">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
