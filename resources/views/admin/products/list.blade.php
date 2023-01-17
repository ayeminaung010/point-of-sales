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
                            <h2 class="title-1">Product Lists</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Products
                            </button>
                        </a>
                    </div>
                </div>

                {{-- //message alert --}}
                {{-- @if(session('createSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if(session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-regular fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if(session('updateSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-regular fa-circle-xmark"></i> {{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif --}}

                {{-- end alert  --}}
                <div class="row">
                    <div class="col-3 ">
                        <h5 class=" text-secondary">Search Key : <span class="text-danger"></span></h5>
                    </div>
                    <div class="col-4 offset-8">
                        <form action="" method="get">
                            @csrf
                            <div class="d-flex ">
                                <input type="text" class="form-control"  value="" placeholder="Search.......">
                                <button class="btn btn-dark text-white " type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> - </h4>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>

                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View count</th>

                            </tr>
                        </thead>
                        <tbody>


                         </tbody>
                    </table>
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

