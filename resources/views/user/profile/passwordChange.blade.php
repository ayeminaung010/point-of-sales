@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#passwordChangePage') }}">Change Password</a>
@endsection


@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content p-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-md-6 offset-3 ">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="password-center title-2 text-center">Change Password </h3>
                        </div>
                        <hr>
                        <form action="{{ route('user#passwordChangeUpdate') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group my-3">
                                <label for="" class="control-label mb-1">Old Password</label>
                                <input id="" name="oldPassword" type="password" value="" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter Old password...">
                                @error('oldPassword')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="" class="control-label mb-1">New Password</label>
                                <input id="" name="newPassword" type="password" value="" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter New password...">
                                @error('newPassword')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="" class="control-label mb-1">Confirm Password</label>
                                <input id="" name="confirmPassword" type="password" value="" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter Confirm password...">
                                @error('confirmPassword')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-warning text-white btn-block my-3">
                                    <i class="fa-solid fa-key"></i>
                                    <span id="payment-button-amount">Change Password</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
