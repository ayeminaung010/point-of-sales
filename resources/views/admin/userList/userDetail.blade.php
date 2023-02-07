@extends('admin.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')

 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <button class="btn btn-dark my-3" onclick="history.back()">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </button>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="password-center title-2 text-center">User Info </h3>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-5 ">
                                @if ($user->image == null)
                                    @if ($user->gender == 'male')
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('image/male.png')}}" class=" img-thumbnail rounded" />
                                            </a>
                                        </div>
                                    @else
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('image/female.jpg')}}" class=" img-thumbnail rounded" />
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('storage/img/user/'. $user->image) }}"  />
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-7">
                                <form action="">
                                    <h4 class="my-3"> <i class="fa-regular fa-circle-user me-2"></i> {{ $user->name }}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-envelope me-2"></i> {{ $user->email }}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-mobile-screen me-2"></i> {{ $user->phone }}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-venus-mars me-2"></i> {{ $user->gender }}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-map-location-dot me-2"></i> {{ $user->address }}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-clock me-2"></i> {{ $user->created_at->format('j-F Y') }}</h4>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5  ">
                                <a href="{{ route('admin#editUserAccount',$user->id) }}" class="w-100">
                                    <button class="btn btn-dark text-white w-100">
                                        <i class="fa-solid fa-user-pen me-2"></i> Edit Profile
                                    </button>
                                </a>
                            </div>
                            <div class="col-5  ">
                                <a href="{{ route('admin#changePasswordUser',$user->id) }}" class="w-100">
                                    <button class="btn btn-dark text-white w-100">
                                        <i class="fa-solid fa-user-pen me-2"></i> Password Change
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
