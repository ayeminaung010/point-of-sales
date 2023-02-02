@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#cart') }}">Cart</a>
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
                                    <p class="mb-0"><span class="fw-bold">Product :</span><span class="c-green">
                                            General products</span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bold">Price :</span>
                                        <span class="c-green" id="total"> Kyats</span>
                                    </p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="{{ route('user#paymentVerify') }}" class="form" method="post" id="form1">
                                        @csrf
                                        <input type="hidden" name="order_code" class="order_code" value="">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">

                                                    <input type="hidden" name="final_price" class="final_price" value="">

                                                    <input type="text" value="{{ old('cardNo') }}" id="cardNo" name="cardNo" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">Card Number</label>
                                                    @error('cardNo')
                                                        <div class="errorMessage" id="cardError">

                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror()
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form__div">
                                                    <input type="text" value="{{ old('expired_date') }}" id="expired_date" name="expired_date" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">MM / yy</label>
                                                    @error('expired_date')
                                                    <div class="errorMessage" id="dateError">

                                                        <small class=" text-danger">{{ $message }}</small>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <input type="password" value="{{ old('cvv_code') }}" id="cvv_code" name="cvv_code" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label" >cvv code</label>
                                                    @error('cvv_code')
                                                    <div class="errorMessage" id="cvvError">

                                                        <small class=" text-danger">{{ $message }}</small>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" value="{{ old('card_name') }}" id="card_name" name="card_name" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">name on the card</label>
                                                    @error('card_name')
                                                    <div class="errorMessage" id="cardNameError">

                                                        <small class=" text-danger">{{ $message }}</small>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class=" ">
                                                <input type="text" value="{{ old('name') }}" id="name" name="name" placeholder="Enter Your Name" class=" form-control my-2 px-2">
                                                @error('name')
                                                <div class="errorMessage" id="nameError">
                                                    <small class=" text-danger">{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class=" ">
                                                <input type="number" value="{{ old('phone') }}" id="phone" name="phone" placeholder="Enter Your phone" class=" form-control my-2 px-2">
                                                @error('phone')
                                                <div class="errorMessage" id="addressError">
                                                    <small class=" text-danger">{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class=" ">
                                                <input type="email" value="{{ old('email') }}" id="email" name="email" placeholder="Enter Your email" class=" form-control my-2 px-2">
                                                @error('email')
                                                <div class="errorMessage" id="addressError">
                                                    <small class=" text-danger">{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class=" ">
                                                <input type="text" value="{{ old('address') }}" id="address" name="address" placeholder="Enter Your Address" class=" form-control my-2 px-2">
                                                @error('address')
                                                <div class="errorMessage" id="addressError">
                                                    <small class=" text-danger">{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class=" ">
                                                <textarea name="message" valur='{{ old('message') }}' id="message" cols="30" rows="10" placeholder="Message(optional)" class=" form-control px-2 py-2 my-2"></textarea>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" id="OrderBtn1" class="btn btn-primary w-100">Order</button>
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
                                        <span class="c-green" id="total"> Kyats</span>
                                    </p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="{{ route('user#verifyWallet') }}" class="form" method="post" enctype="multipart/form-data" id="form2">
                                        @csrf
                                        <div class="row">
                                            <div class=" col-12">
                                                <div class="">
                                                    <input type="hidden" name="order_code" class="order_code" value="">
                                                    <input type="hidden" name="final_price" class="final_price" value="">
                                                    <select name="paymentMethod" id="paymentMethod"  class=" form-control my-2 px-2">
                                                        <option value="">Choose Payment</option>
                                                        <option value="wave-money" {{ old('paymentMethod') == 'wave-money' ? 'selected' : '' }}>Wave Pay</option>
                                                        <option value="k-pay" {{ old('paymentMethod') == 'k-pay' ? 'selected' : '' }}>K Pay</option>
                                                        <option value="aya-pay" {{ old('paymentMethod') == 'aya-pay' ? 'selected' : '' }}>AYA Pay</option>
                                                    </select>
                                                    @error('paymentMethod')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="">
                                                    <label for="">Upload Your ScreenShot</label>
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="image" class="form-control" id="inputGroupFile02">
                                                        {{-- <label class="input-group-text" for="inputGroupFile02">Upload</label> --}}
                                                    </div>
                                                    @error('image')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class=" ">
                                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Your Name" class=" form-control my-2 px-2">
                                                    @error('name')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class=" ">
                                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Your email" class=" form-control my-2 px-2">
                                                    @error('email')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class=" ">
                                                    <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Enter Your phone" class=" form-control my-2 px-2">
                                                    @error('phone')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class=" ">
                                                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Enter Your Address" class=" form-control my-2 px-2">
                                                    @error('address')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class=" ">
                                                        <textarea name="message" id="" cols="30" rows="10" placeholder="Message(optional)" class=" form-control px-2 py-2 my-2">{{ old('message') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button  id="OrderBtn2" class="btn btn-primary w-100">Order</button>
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

    <script>
        const orderList = localStorage.getItem('order_list');
        const final_price = localStorage.getItem('final_price') //form localStorage
        const orderCode = localStorage.getItem('order_code') //form localStorage

        const finalPrices = document.querySelectorAll('.final_price');
        const totals = document.querySelectorAll('#total');
        const orderCodes = document.querySelectorAll('.order_code');

        finalPrices.forEach((finalPrice) =>{
            finalPrice.value = final_price
        })

        totals.forEach((total) => {
            total.innerHTML = final_price + 'Kyats';
        })
        orderCodes.forEach((orderCode) =>{
            orderCode.value = localStorage.getItem('order_code')
        })


    </script>
@endsection








