@extends('admin.layouts.master')

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
                            <h2 class="title-1"> Contact Details </h2>
                        </div>
                    </div>

                </div>
                <div class="card-title">
                    <button class="btn btn-dark " onclick="history.back()">
                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                    </button>
                </div>


                <div class="row col-5">
                    <div class="card mt-4">
                        <div class="cart-title fw-bold text-center mt-3">User Info

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-user me-2"></i>Name</div>
                                <div class="col"> {{ $message->name}} </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><i class="fa-solid fa-envelope me-2"></i>Email</div>
                                <div class="col"> {{ $message->email}} </div>
                            </div>

                            <div class="row">
                                <div class="col-5"><i class="fa-regular fa-clock me-2"></i>Date Time </div>
                                <div class="col"> {{ $message->created_at->format('j-F-Y')}} <br> {{ $message->created_at->diffForHumans()}}  </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row col-12">
                    <div class="card mt-4">
                        <div class="cart-title fw-bold text-center mt-3">Description

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-spa me-2"></i> Subject </div>
                                <div class="col">  {{ $message->subject}} </div>
                            </div>
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-envelope-open me-2"></i> Message </div>
                                <div class="col">  {{ $message->message}} </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection

