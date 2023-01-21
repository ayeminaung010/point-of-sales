@extends('user.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#profile') }}">Profile</a>
@endsection


@section('content')

    <div class="row">
        <div class="col-lg-10 offset-1">
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">
                                    @if (Auth::user()->image === null)
                                        @if (Auth::user()->gender = 'male')
                                        <img src="{{ asset('image/male.png')}}" class="img-radius w-50 rounded-pill" alt="User-Profile-Image">
                                        @else
                                        <img src="{{ asset('image/female.jpg')}}" class="img-radius w-50 rounded-pill" alt="User-Profile-Image">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/img/user/'. Auth::user()->image) }}" class="img-radius w-50 rounded-pill" alt="User-Profile-Image">
                                    @endif
                                </div>
                                <h6 class="f-w-600  text-white text-uppercase text-bold ">{{ Auth::user()->name }}</h6>
                                <a href="{{ route('user#editPage') }}" class=" text-white">
                                    <i class="fa-regular fa-pen-to-square"></i> <span>Edit</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Profile </h6>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">{{ Auth::user()->email }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400">{{ Auth::user()->phone }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Gender</p>
                                        <h6 class="text-muted f-w-400 text-capitalize">{{ Auth::user()->gender }}</h6>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="m-b-10 f-w-600">Address</p>
                                        <h6 class="text-muted f-w-400">{{ Auth::user()->address }}</h6>
                                    </div>
                                </div>
                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true" class=" text-info"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true" class=" text-info"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true" class=" text-danger"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
