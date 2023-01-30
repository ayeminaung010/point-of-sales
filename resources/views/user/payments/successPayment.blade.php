@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#cart') }}">Cart</a>
    <a class="breadcrumb-item text-dark" href="{{ route('user#payment') }}">Payments</a>
    <a class="breadcrumb-item text-dark" href="{{ route('user#payment') }}">Success</a>
@endsection

@section('content')
<div class="row">

    <div class="col-lg-5 offset-3 bg-white shadow-md">
        <div class=" py-4 px-5">
            <div class="text-center">
                <div class=" my-4">
                    <h2 class=" text-success ">Payment SuccessFull!</h2>
                </div>
                <div class=" text-success  my-4">
                    <i class="fa-regular fa-circle-check " style="font-size: 70px"></i>
                </div>
            </div>
            <div class="row my-5">
                <div class=" col-lg-6">
                    <div class="">Payment Type</div>
                    <div class="">Bank</div>
                    <div class="">Mobile</div>
                    <div class="">Email</div>
                    <div class="my-4">Amount Paid</div>
                    <div class="">Transaction id</div>
                </div>
                <div class=" col-lg-6 text-end " style=" font-weight:bold;">
                    <div class=" ">Payment Type</div>
                    <div class="">Bank</div>
                    <div class="">Mobile</div>
                    <div class="">Email</div>
                    <div class="my-4">Amount Paid</div>
                    <div class="">Transaction id</div>
                </div>
                <div class="text-center mt-4">
                    <button class=" btn btn-primary px-4 py-2 mx-2 text-uppercase">Print</button>
                    <button class=" btn btn-primary px-4 py-2 mx-2 text-uppercase">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scriptSource')
    <script src="{{ asset('js/payment.js') }}"></script>
@endsection
