@extends('layouts.app')

@section('title')
Register
@endsection


@section('content')

<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{ asset('admin/images/icon/logo.png') }}" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input class="au-input au-input--full" type="text" name="name"  placeholder="Username">
                                @error('name')
                                 <small class=" text-danger">{{ $message  }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="au-input au-input--full" type="email" name="email" val placeholder="Email">
                                @error('email')
                                 <small class=" text-danger">{{ $message  }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="au-input au-input--full" type="number" name="phone" placeholder="09xxxxx">
                                @error('phone')
                                 <small class=" text-danger">{{ $message  }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="au-input au-input--full" type="text" name="address" placeholder="Enter Address">
                                @error('address')
                                 <small class=" text-danger">{{ $message  }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                @error('password')
                                 <small class=" text-danger">{{ $message  }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
                                @error('password_confirmation')
                                 <small class=" text-danger">{{ $message  }}</small>
                                @enderror
                            </div>

                            
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

                        </form>
                        <div class="register-link">
                            <p>
                                Already have account?
                                <a href="{{ route('loginPage') }}">Sign In</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
