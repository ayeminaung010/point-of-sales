@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#cart') }}">Cart</a>
@endsection

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            @if(count($carts) !== 0)
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                        <tr id="currentProduct">
                            <td><img src="{{ asset('storage/img/product/'.$cart->productImage) }}" class=" img-thumbnail shadow-sm" alt="" style="width: 100px"></td>
                            <input type="hidden" value="{{ $cart->user_id }}" class="userId">
                            <input type="hidden" value="{{ $cart->id }}" class="cartId">
                            <input type="hidden" value="{{ $cart->product_id }}" class="productId">
                            @if ($cart->discountPrice)
                                <td class="align-middle" id="productPrice">{{ $cart->discountPrice }}  kyats</td>
                            @else
                                <td class="align-middle" id="productPrice">{{ $cart->productPrice }}  kyats</td>
                            @endif

                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="qty"  value="{{ $cart->qty }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            @if ($cart->discountPrice)
                                <td class="align-middle col-3" id="total">{{ $cart->discountPrice * $cart->qty }}  kyats</td>
                            @else
                                <td class="align-middle col-3" id="total">{{ $cart->productPrice * $cart->qty }}  kyats</td>
                            @endif

                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" id="btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal"> kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">5000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5  id="finalPrice">kyats</h5>
                            <input type="hidden" name="finalPrice" id="finalPriceInput" value="">
                        </div>
                        <button  class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="checkOut">Proceed To Checkout</button>
                        <button class="btn btn-block btn-outline-danger font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
            @else
                <div class=" d-flex  flex-column justify-content-center align-items-center">
                    <p class="text-center fs-2 p-5">Nothing in Cart! <i class="fa-solid fa-pizza-slice ms-3"></i> </p>
                    <a href="{{ route('user#home') }}" class="btn btn-primary ">GO SHOPPING</a>
                </div>
            @endif

        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')

<script src="{{ asset('js/cart.js') }}"></script>

@endsection
