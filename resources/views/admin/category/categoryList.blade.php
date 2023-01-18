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
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('admin#categoryCreatePage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>created at</th>
                                <th>Updated at</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($categories  as $category  )
                           <tr class="tr-shadow">
                                <td>{{  $category->id }}</td>
                                <td>
                                    <span class="block-email text-bold text-dark">{{  $category->name }}</span>
                                </td>
                                <td class="desc">{{  $category->created_at->diffForHumans() }}</td>
                                <td class="desc">{{  $category->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('admin#categoryEdit',$category->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="{{ route('admin#categoryDelete',$category->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

