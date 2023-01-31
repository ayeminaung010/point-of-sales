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
                                        <span class="c-green" id="finalPrice"> Kyats</span>
                                    </p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="{{ route('user#paymentVerify') }}" class="form" method="post" id="form1">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" value="{{ old('cardNo') }}" id="cardNo" name="cardNo" class="form-control" placeholder=" ">
                                                    <label for="" class="form__label">Card Number</label>
                                                    @error('cardNo')
                                                        <div class="errorMessage" id="cardError">
                                                            {{-- <small class=" text-danger">Fill Card Number</small> --}}
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
                                                        {{-- <small class=" text-danger">Fill this Field</small> --}}
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
                                                        {{-- <small class=" text-danger">Fill this Field</small> --}}
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
                                                        {{-- <small class=" text-danger">Fill name on the card</small> --}}
                                                        <small class=" text-danger">{{ $message }}</small>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class=" ">
                                                <input type="text" value="{{ old('name') }}" id="name" name="name" placeholder="Enter Your Name" class=" form-control my-2 px-2">
                                                @error('name')
                                                <div class="errorMessage" id="nameError">
                                                    {{-- <small class=" text-danger">Fill name</small> --}}
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
                                        <span class="c-green" id="finalPrice"> Kyats</span>
                                    </p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="" class="form" method="post" id="form2">
                                        @csrf
                                        <div class="row">
                                            <div class=" col-12">
                                                <div class="">
                                                    <select name="paymentMethod" id="paymentMethod"  class=" form-control my-2 px-2">
                                                        <option value="">Choose Payment</option>
                                                        <option value="wave-money">Wave Pay</option>
                                                        <option value="k-pay">K Pay</option>
                                                        <option value="aya-pay">AYA Pay</option>
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
                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                    </div>
                                                    @error('image')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class=" ">
                                                    <input type="text" name="name" placeholder="Enter Your Name" class=" form-control my-2 px-2">
                                                    @error('name')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class=" ">
                                                    <input type="text" name="address" placeholder="Enter Your Address" class=" form-control my-2 px-2">
                                                    @error('address')
                                                        <div class="errorMessage">
                                                            <small class=" text-danger">{{ $message }}</small>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class=" ">
                                                        <textarea name="" id="" cols="30" rows="10" placeholder="Message(optional)" class=" form-control px-2 py-2 my-2"></textarea>
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
        const orderList = localStorage.getItem('final_price');
        const final_price = localStorage.getItem('final_price') //form localStorage
        const finalPrices = document.querySelectorAll('#finalPrice');
        const OrderBtn1 = document.querySelector('#OrderBtn1');
        const OrderBtn2 = document.querySelector('#OrderBtn2');
        finalPrices.forEach((finalPrice) =>{
            finalPrice.innerHTML = final_price + 'Kyats'
        })


        OrderBtn1.addEventListener('',function(){
            const cardNo = document.querySelector('#cardNo');
            const expired_date = document.querySelector('#expired_date');
            const cvv_code = document.querySelector('#cvv_code');
            const card_name = document.querySelector('#card_name');
            const name = document.querySelector('#name');
            const address = document.querySelector('#address');
            const message = document.querySelector('#message');

            const cardError = document.querySelector('#cardError');
            const dateError = document.querySelector('#dateError');
            const cvvError = document.querySelector('#cvvError');
            const cardNameError = document.querySelector('#cardNameError');
            const nameError = document.querySelector('#nameError');
            const addressError = document.querySelector('#addressError');
            console.log('hell');
            // if(cardNo.value === '' || cardNo.value === undefined || cardNo.value === null){
            //     cardError.classList.replace('d-none','block')
            // }
            //  if(expired_date === '' || expired_date.value === undefined || expired_date.value === null){
            //     dateError.classList.replace('d-none','block')
            // }
            //  if(cvv_code === '' || cvv_code.value === undefined || cvv_code.value === null){
            //     cvvError.classList.replace('d-none','block')
            // }
            //  if(card_name === '' || card_name.value === undefined || card_name.value === null){
            //     cardNameError.classList.replace('d-none','block')
            // }
            //  if(name === '' || name.value === undefined || name.value === null){
            //     nameError.classList.replace('d-none','block')
            // }
            //  if(address === '' || address.value === undefined || address.value === null){
            //     addressError.classList.replace('d-none','block')
            // }

        })

        const form1 = document.querySelector('#form1');

        form1.addEventListener('submit',function(){

        })
    </script>
@endsection








