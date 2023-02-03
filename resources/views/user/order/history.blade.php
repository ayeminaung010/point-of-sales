@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#orderHistory',Auth::user()->id) }}">History</a>
@endsection

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                @if (count($orders) !== 0)
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($orders as $o )
                                <tr>
                                    <td class="align-middle" > {{ $o->created_at->format('d-M-Y')}} </td>
                                    <td class="align-middle" >
                                        <a href="{{ route('user#orderProducts',$o->order_code ) }}" class=" btn btn-primary">{{ $o->order_code}} </a>
                                    </td>
                                    <td class="align-middle" > {{ $o->total_price}} Kyats</td>
                                    <td class="align-middle" >
                                        @if ( $o->status == 0 )
                                            <span class="text-warning"> <i class="fa-solid fa-person-running me-2"></i>Pending..</span>
                                        @elseif($o->status == 1)
                                            <span class="text-success"> <i class="fa-solid fa-circle-check me-2"></i> Success</span>
                                        @elseif($o->status == 2)
                                            <span class="text-danger"> <i class="fa-solid fa-circle-exclamation me-2"></i> Reject</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{-- {{ $order->links() }} --}}
                    </div>
                @else
                <div class=" d-flex  flex-column justify-content-center align-items-center">
                    <p class="text-center fs-2 p-5">Nothing in History! </p>
                    <a href="{{ route('user#home') }}" class="btn btn-primary ">GO SHOPPING</a>
                </div>
                @endif
            </div>

        </div>
    </div>
    <!-- Cart End -->

@endsection


