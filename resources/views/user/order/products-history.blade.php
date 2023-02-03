@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#orderHistory',Auth::user()->id) }}">History</a>
@endsection

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid"></div>
        <button  onclick="history.back()" class="btn btn-primary my-2 ms-5  text-white">
            <i class="fa-solid fa-arrow-left fs-5"></i> <span class="fs-6">Back</span>
        </button>
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orderLists as $orderList )
                            <tr>
                                <td class="align-middle" > {{ $orderList->product_name }} </td>
                                <td class="align-middle" >
                                    <img src="{{ asset('storage/img/product/'.$orderList->product_image) }}" class="w-25" style="height: 100px" alt="">
                                </td>
                                <td class="align-middle" > {{ $orderList->qty}}</td>
                                <td class="align-middle"> {{ $orderList->total }} Kyats</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{-- {{ $order->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection


