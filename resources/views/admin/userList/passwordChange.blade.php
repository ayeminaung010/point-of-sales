@extends('admin.layouts.master')

@section('title','Account Profile')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-8 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="password-center title-2 text-center">Change User or Lock Password </h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#UpdatePasswordUser',$user->id) }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="control-label mb-1">Name</label>
                                <input id="" name="" type="text" value="{{ $user->name }}" class="form-control" aria-required="true" aria-invalid="false" placeholder="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label mb-1">New Password</label>
                                <input id="" name="newPassword" type="password" value="" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="new password...">
                                @error('newPassword')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label mb-1">Confirm Password</label>
                                <input id="" name="confirmPassword" type="password" value="" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="confirm password...">
                                @error('confirmPassword')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key"></i>
                                    <span id="payment-button-amount">Change User Password</span>
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
@endsection
