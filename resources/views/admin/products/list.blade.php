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
                        <a href="{{ route('admin#productCreatePage') }}">
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
                        <h5 class=" text-secondary">Search : <span class="text-danger">{{ request('search') }}</span></h5>
                    </div>
                    <div class="col-4 offset-8">
                        <form action="{{ route('admin#productList') }}" method="get">
                            @csrf
                            <div class="d-flex ">
                                <input type="text" class="form-control"  value="{{ request('search') }}" name="search" placeholder="Search.......">
                                <button class="btn btn-dark text-white " type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> - {{ count($products) }} </h4>
                    </div>
                </div>
                @if (count($products) !== 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Category Name</th>
                                <th>View count</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($products as $p )
                                <tr class="tr-shadow ">
                                    <td class="col-2 "> <img src="{{ asset('storage/img/product/'.$p->image) }}" class=" img-thumbnail shadow-sm  "  alt=""> </td>
                                    <td class="col-3"> {{  $p->name }} </td>
                                    <td class="col-2"> {{  $p->price }}</td>
                                    <td class="col-2"> {{  $p->category->name}}</td>
                                    <td class="col-2"><i class="fa-solid fa-eye"></i> {{  $p->view_count }}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">

                                        <a href="{{ route('admin#productDetail',$p->id) }}" class="me-2" >
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                <i class="fa-regular fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin#productEditPage',$p->id) }}"  class="me-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin#productDelete',$p->id) }}" class="me-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>

                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                                <div class=" my-3">
                                    {{ $products->links() }}
                                </div>

                         </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center text-bold fs-4">There is no products </div>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

