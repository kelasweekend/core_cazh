@extends('layouts.backend.master')

@section('title')
    Welcome To Dashboard
@endsection
@section('content')
    <div class="row justify-content-center" style="margin-top: 60px;">
        <div class="col-md-6 col-10">
            <div class="text-center">
                <img src="{{ asset('assets/img/home.svg') }}" width="300" alt="">
                <h2 class="fw-bold mt-3">Welcome To Dashboard</h2>
                <p class="text-muted">Made With
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heartbeat text-danger" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M19.5 13.572l-7.5 7.428l-2.896 -2.868m-6.117 -8.104a5 5 0 0 1 9.013 -3.022a5 5 0 1 1 7.5 6.572">
                        </path>
                        <path d="M3 13h2l2 3l2 -6l1 3h3"></path>
                    </svg>
                    Fauzan Taqiyuddin
                </p>
            </div>
        </div>
    </div>
@endsection
