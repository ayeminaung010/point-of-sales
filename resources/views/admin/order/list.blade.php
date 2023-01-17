@extends('admin.layouts.master')

@section('content')

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

                <div class="row my-2">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> -</h4>
                    </div>
                </div>

                <form action="" method="post">

                    @csrf

                    <div class="input-group mb-3">

                        {{-- <select name="orderStatus" id="orderStatus" class="form-control col-2">
                            <option value="">All</option>
                            <option value="0" @if(request('orderStatus') == '0' ) selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus') == '1' ) selected @endif>Success</option>
                            <option value="2" @if(request('orderStatus') == '2' ) selected @endif>Reject</option>
                        </select> --}}
                        <button type="submit" class="btn btn-dark text-white " id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> </button>

                    </div>

                </form>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="dataList">

                         </tbody>
                    </table>
                </div>


                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

