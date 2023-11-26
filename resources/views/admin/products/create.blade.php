@extends('admin.layouts.master')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8 ">
                        <a href="{{ route('admin#productList') }}"><button class="btn bg-dark text-white my-3"> Lists</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Products </h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#productCreate') }}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Name</label>
                                    <input id="" name="productName" type="text" value="{{ old('productName')}}" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product name...">
                                    @error('productName')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Category</label>
                                    <select name="productCategory" id="" class="form-control @error('productCategory') is-invalid @enderror" >
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}" {{ (old("productCategory") == $c->id ? "selected":"") }}> {{ $c->name}} </option>
                                        @endforeach
                                    </select>
                                    @error('productCategory')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Description</label>
                                    <textarea name="productDescription" id="" class="form-control @error('productDescription') is-invalid @enderror" placeholder="Enter Description" cols="30" rows="10">{{ old('productDescription')}}</textarea>
                                    @error('productDescription')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Image</label>
                                    <input type="file" name="productImage" class="form-control @error('productImage') is-invalid @enderror" id="">
                                    @error('productImage')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Waiting Time</label>
                                    <input id="" name="productWaitingTime" type="number" value="{{ old('productWaitingTime')}}" class="form-control @error('productWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Waiting Time...">
                                    @error('productWaitingTime')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Price</label>
                                    <input id="" name="productPrice" type="number" value="{{ old('productPrice')}}" class="form-control @error('productPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product price...">
                                    @error('productPrice')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Discount Price</label>
                                    <input id="" name="discount_price" type="number" value="{{ old('discount_price')}}" class="form-control @error('discount_price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter discount price...">
                                    @error('discount_price')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Discount Percent %</label>
                                    <input id="" name="discount_percentage" type="number" value="{{ old('discount_percentage')}}" class="form-control @error('discount_percentage') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter discount percent %...">
                                    @error('discount_percentage')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
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
