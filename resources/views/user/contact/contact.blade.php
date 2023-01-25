@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#contact') }}">Contact</a>
@endsection

@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content p-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid row">

            <div class="col-md-6  ">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="password-center title-2 text-center">Contact Us</h3>
                        </div>
                        <hr>
                        <form action="{{ route('user#sendToAdmin')}}" method="post" novalidate="novalidate">
                            @csrf

                            <div class="form-group my-3 row">
                                <div class="col">
                                    <label for="" class="control-label mb-1 fw-bold">Name</label>
                                    <input id="" name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter your name...">
                                    @error('name')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="" class="control-label mb-1 fw-bold">Email </label>
                                    <input id="" name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter your email...">
                                    @error('email')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="" class="control-label mb-1 fw-bold">Subject</label>
                                <input id="" name="subject" type="text" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter Subject...">
                                @error('subject')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="" class="control-label mb-1 fw-bold">Message</label>
                                <textarea name="message" id="" class="form-control @error('message') is-invalid @enderror" cols="30" rows="10" placeholder="Enter your message...">{{ old('message') }}</textarea>
                                @error('message')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-warning text-white btn-block my-3">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span id="payment-button-amount">Send</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, Yangon, Myanmar</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>shopmm@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+9598485745</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
