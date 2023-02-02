@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#cart') }}">Cart</a>
@endsection

@section('content')
<div class="row">

    <div class="col-lg-5 offset-3  shadow-md">
        <div class=" py-5 px-5">
            <div class="text-center">
                <div class=" my-4">
                    <h1 class=" text-primary ">Your Order Recieved!</h1>
                    <h2 class=" text-success ">Payment SuccessFull!</h2>
                </div>
                <div class=" text-success  my-4">
                    <i class="fa-regular fa-circle-check " style="font-size: 70px"></i>
                </div>
            </div>
            <div class="row my-5">
                <div class=" col-lg-6">
                    <div class="">Payment Type</div>
                    <div class="">Mobile</div>
                    <div class="">Email</div>
                    <div class='my-4'>
                        <div class="">Amount Paid</div>
                    </div>
                    <div class="">Transaction id</div>
                </div>
                <div class=" col-lg-6 text-end " style=" font-weight:bold;">
                    <div class=" ">{{ $data['method'] }}</div>
                    <div class="">{{ $data['phone'] }}</div>
                    <div class="">{{ $data['email'] }}</div>
                    <div class='my-4'>
                        <div class="" id="order_total"></div>
                    </div>
                    <div class="">{{ $data['transactionId'] }}</div>
                </div>
                <div class="text-center mt-4">
                    <button class=" btn btn-primary px-4 py-2 mx-2 text-uppercase" id="print">Print</button>
                    <a href="{{ route('user#home') }}">
                        <button class=" btn btn-primary px-4 py-2 mx-2 text-uppercase" >Go To Home</button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scriptSource')
    <script src="{{ asset('js/payment.js') }}"></script>
    <script>
        console.log(localStorage.getItem('final_price'));


        const total = document.querySelector('#order_total');
        total.innerHTML = localStorage.getItem('final_price') + 'Kyats';
        // window.location.href = '/user/home';
        const printBtn = document.querySelector('#print');
        printBtn.addEventListener('click',function(){
            window.print();
        })
    </script>
@endsection
