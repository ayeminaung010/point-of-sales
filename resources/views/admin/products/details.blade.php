@extends('admin.layouts.master')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-dark" onclick="history.back()">
                                <i class="fa-solid fa-arrow-left me-2"></i>Back
                            </button>
                            <hr>

                            <div class="row">
                                <div class="col-5 ">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('storage/img/product/'.$product->image) }}" class="img-thumbnail shadow-sm" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <form action="">
                                        <div class="my-3 bg-danger btn btn-danger d-block w-50"> <i class="fa-solid fa-pizza-slice me-2"></i> {{ $product->name }}</div>


                                        <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-hand-holding-dollar me-2"></i> {{ $product->price }} kyats</span>
                                        <span class="my-3 btn bg-dark text-white"> <i class="fa-regular fa-clock me-2"></i>  {{ $product->waiting_time }} mins </span>
                                        <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-clone me-2"></i> {{ $product->category_name }}  </span>
                                        <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-eye"></i> {{ $product->view_count }}</span>
                                        <div class="my-3"> <i class="fa-solid fa-clock me-2"></i> {{ $product->created_at->format('j-F Y') }}</div>

                                        <div class="my-3"> <i class="fa-regular fa-comments me-2"></i> {{ $product->description }}</div>
                                    </form>
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
