@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#cart') }}">Cart</a>
    <a class="breadcrumb-item text-dark" href="{{ route('user#payment') }}">Payments</a>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Payment Methods</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">Credit Card</span>
                                <span class="">
                                    <span class="fab fa-cc-amex"></span>
                                    <span class="fab fa-cc-mastercard"></span>
                                    <span class="fab fa-cc-discover"></span>
                                </span>
                            </a>
                        </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample2">
                            <div class="row">
                                <div class="col-lg-5 mb-lg-0 mb-3">
                                    <p class="h4 mb-0">Summary</p>
                                    <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">
                                            General products</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bold">Price:</span>
                                        <span class="c-green">{{ $finalPrice }} Kyats</span>
                                    </p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="" class="form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">Card Number</label>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <input type="text" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">MM / yy</label>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <input type="password" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">cvv code</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">name on the card</label>
                                                </div>
                                            </div>
                                            <div class=" ">
                                                <input type="text" placeholder="Enter Your Name" class=" form-control my-2 px-2">
                                            </div>
                                            <div class=" ">
                                                <input type="text" placeholder="Enter Your Address" class=" form-control my-2 px-2">
                                            </div>
                                            <div class=" ">
                                                    <textarea name="" id="" cols="30" rows="10" placeholder="Message(optional)" class=" form-control px-2 py-2 my-2"></textarea>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary w-100">Sumbit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">Mobile Wallet</span>
                                <span class="">
                                    <span>
                                        <img src="{{ asset('image/AYAPay.png') }}" class="" style="width:60px" alt="">
                                    </span>
                                    <span>
                                        <img src="{{ asset('image/kbzpay.jpg') }}" class="" style="width:60px" alt="">
                                    </span>
                                    <span>
                                        <img src="{{ asset('image/wavepay.png') }}" class="" style="width:60px" alt="">
                                    </span>
                                </span>
                            </a>
                        </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample1">
                            <div class="row">
                                <div class="col-lg-5 mb-lg-0 mb-3">
                                    <p class="h4 mb-0">Summary</p>
                                    <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">
                                            General products</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bold">Price:</span>
                                        <span class="c-green">{{ $finalPrice }} Kyats</span>
                                    </p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="" class="form">
                                        @csrf
                                        <div class="row">
                                            <div class=" col-12">
                                                <div class="">
                                                    <select name="paymentMethod" id="" class=" form-control my-2 px-2">
                                                        <option value="">Choose Payment</option>
                                                        <option value="">Wave Pay</option>
                                                        <option value="">K Pay</option>
                                                        <option value="">AYA Pay</option>
                                                    </select>
                                                </div>
                                                <div class="">
                                                    <label for="">Upload Your ScreenShot</label>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" id="inputGroupFile02">
                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                    </div>
                                                </div>
                                                <div class=" ">
                                                    <input type="text" placeholder="Enter Your Name" class=" form-control my-2 px-2">
                                                </div>
                                                <div class=" ">
                                                    <input type="text" placeholder="Enter Your Address" class=" form-control my-2 px-2">
                                                </div>
                                                <div class=" ">
                                                        <textarea name="" id="" cols="30" rows="10" placeholder="Message(optional)" class=" form-control px-2 py-2 my-2"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary w-100">Sumbit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script src="{{ asset('js/payment.js') }}"></script>
@endsection
