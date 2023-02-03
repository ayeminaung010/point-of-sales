@extends('admin.layouts.master')

@section('title','Product Lists')
@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order Lists</h2>
                        </div>
                    </div>

                </div>
                <button class="btn btn-dark" onclick="history.back()">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </button>

                <div class="row ">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> -{{count($orderLists)}}</h4>
                    </div>
                </div>

                <div class="row ">
                    {{-- order info  --}}
                    <div class="col-6">
                        <div class="card mt-4">
                            <div class="cart-title fw-bold text-center mt-3 fs-3"> <i class="fa-solid fa-baby-carriage"></i> Order Info
                            </div>
                            <small class=" text-warning text-center"> <i class="fa-solid fa-triangle-exclamation"></i> Include Delivery Charges</small>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-user me-1"></i> User Name</div>
                                    <div class="col">  {{ strtoupper($orderLists[0]->username) }} </div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-id-card-clip me-1"></i> Order Code</div>
                                    <div class="col"> {{ $orderLists[0]->order_code}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-clock me-1"></i> Order Date </div>
                                    <div class="col">  {{ $orderLists[0]->created_at->format('j-F-Y')}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-money-check-dollar me-1"></i> Total </div>
                                    <div class="col">  {{ $order[0]->total_price }} kyats</div>
                                </div>
                            </div>
                        </div>

                        @if ($payment[0]->payment_name)
                            <div class="">
                                <img src="{{ asset('storage/img/user/payment/'.$payment[0]->image) }}" class=" w-100" alt="">
                            </div>
                        @endif
                    </div>

                    {{-- payment info  --}}
                    <div class="col-6">
                        @if ($payment[0]->card_name)
                        <div class="card mt-4">
                            <div class="cart-title fw-bold text-center mt-3 fs-3"> <i class="fa-solid fa-file-invoice me-1"></i> Payment Info
                            </div>
                            <small class=" text-warning text-center"> <i class="fa-solid fa-triangle-exclamation"></i> Include Delivery Charges</small>
                            <div class="card-body ">
                                <div class="row ">
                                    <div class="col-5"><i class="fa-solid fa-credit-card me-1"></i>Card Holder Name</div>
                                    <div class="col">  {{ strtoupper($payment[0]->card_name) }} </div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-list-ol me-1"></i></i>Card Number</div>
                                    <div class="col"> {{ $payment[0]->card_number}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-calendar-days me-1"></i> Expired Date </div>
                                    <div class="col">  {{ $payment[0]->expired_date }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-fingerprint me-1"></i> Transaction ID  </div>
                                    <div class="col">  {{ $payment[0]->transaction_id }}</div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-5"><i class="fa-solid fa-circle-user me-1"></i> Name </div>
                                    <div class="col">  {{ $payment[0]->name }}</div>
                                </div>
                                <div class="row ">
                                    <div class="col-5"><i class="fa-solid fa-envelope-open-text me-1"></i> Email </div>
                                    <div class="col">  {{ $payment[0]->email }}</div>
                                </div>
                                <div class="row ">
                                    <div class="col-5"><i class="fa-solid fa-mobile-screen-button me-1"></i> Phone </div>
                                    <div class="col">  {{ $payment[0]->phone }}</div>
                                </div>
                                <div class="row ">
                                    <div class="col-5"><i class="fa-solid fa-location-dot me-1"></i> Address </div>
                                    <div class="col">  {{ $payment[0]->address }}</div>
                                </div>

                            </div>
                        </div>
                        @else
                        <div class="card mt-4">
                            <div class="cart-title fw-bold text-center mt-3 fs-3"> <i class="fa-solid fa-file-invoice me-1"></i> Payment Info
                            </div>
                            <small class=" text-warning text-center"> <i class="fa-solid fa-triangle-exclamation"></i> Include Delivery Charges</small>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-wallet me-1"></i>Payment Name</div>
                                    <div class="col">  {{ strtoupper($payment[0]->payment_name) }} </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-money-check-dollar me-1"></i> Total </div>
                                    <div class="col">  {{ $order[0]->total_price }} kyats</div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-5"><i class="fa-solid fa-fingerprint me-1"></i> Transaction ID  </div>
                                    <div class="col">  {{ $payment[0]->transaction_id }}</div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-5"><i class="fa-solid fa-circle-user me-1"></i> Name </div>
                                    <div class="col">  {{ $payment[0]->name }}</div>
                                </div>
                                <div class="row ">
                                    <div class="col-5"><i class="fa-solid fa-envelope-open-text me-1"></i> Email </div>
                                    <div class="col">  {{ $payment[0]->email }}</div>
                                </div>
                                <div class="row ">
                                    <div class="col-5"><i class="fa-solid fa-mobile-screen-button me-1"></i> Phone </div>
                                    <div class="col">  {{ $payment[0]->phone }}</div>
                                </div>
                                <div class="row ">
                                    <div class="col-5"><i class="fa-solid fa-location-dot me-1"></i> Address </div>
                                    <div class="col">  {{ $payment[0]->address }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
                <div class="table-responsive table-responsive-data2 ">
                    <table class="table table-data2 w-100">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Order Time</th>
                            </tr>
                        </thead>
                        <tbody class="dataList ">
                            @foreach ($orderLists as $o )
                            <tr>
                                <td class="">
                                    <img src="{{ asset('storage/img/product/'.$o->productImage) }}" style="height: 150px;width:130px" class=" img-thumbnail object-cover" alt="">
                                </td>
                                <td>{{ $o->productName }}</td>
                                <td>{{ $o->qty }}</td>
                                <td>{{ $o->total }} Kyats</td>
                                <td>{{ $o->created_at->format('j-F-y')}}</td>
                                <td>{{ $o->created_at->diffForHumans()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class=" my-3">
                    {{-- {{ $order->links() }} --}}
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
@section('scriptSource')

@endsection

