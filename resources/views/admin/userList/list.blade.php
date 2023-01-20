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
                            <h2 class="title-1">User Lists</h2>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-3 ">
                        <h5 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key')}}</span></h5>
                    </div>
                    <div class="col-4 offset-8">
                        <form action="{{ route('admin#userList') }}" method="get">
                            @csrf
                            <div class="d-flex ">
                                <input type="text" class="form-control" name="key" value="{{ request('key')}}" placeholder="Search.......">
                                <button class="btn btn-dark text-white " type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> -{{ count($users)}}</h4>
                    </div>
                </div>


                @if (count($users) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Address</th>

                            </tr>
                        </thead>
                        <tbody class="dataList">
                            @foreach ($users as $u)
                                <tr>
                                    <input type="hidden" name="" class="userId" value="{{ $u->id }}">
                                    <td class="col-1 shadow-sm">
                                        @if ($u->image == null )
                                            @if ($u->gender == 'male')
                                                <div class=" img-thumbnail shadow-sm"><img src="{{ asset('image/male.png')}}"  alt=""></div>
                                            @else
                                                <div class="img-thumbnail shadow-sm"><img src="{{ asset('image/female.jpg')}}" alt=""></div>
                                            @endif
                                        @else
                                            <div class="img-thumbnail shadow-sm"><img src="{{ asset('storage/img/'.$u->image)}}" alt=""></div>
                                        @endif
                                     </td>
                                    <td> {{ $u->name }}</td>
                                    <td> {{ $u->email }}</td>
                                    <td> {{ $u->phone }}</td>
                                    <td> {{ $u->gender }}</td>
                                    <td> {{ $u->address }}</td>
                                    <td class="">
                                        <div class="table-data-feature">
                                            <select name="role" id="" class="roleChange form-control">
                                                <option value="admin" @if($u->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if($u->role == 'user') selected @endif>User</option>
                                            </select>

                                            <a href="" class="ms-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>

                                            <a href="" class="ms-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                         </tbody>
                    </table>
                </div>
                <div class=" my-3">
                    {{ $users->links() }}
                </div>
                @else
                    <h4 class=" text-secondary text-center my-3">There is no user Here!</h4>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        $('.roleChange').change(function(){
          $role = $(this).val()
          $parentNode = $(this).parents("tr")
          $userId = $parentNode.find('.userId').val()
            $data = {
                'role' : $role,
                'userId' : $userId
            }
            $.ajax({
                type : 'get',
                url  : '/order/ajax/roleChange',
                data : $data,
                dataType : 'json',
                success : function(response){

                }
            })
        })

    })
</script>
@endsection
