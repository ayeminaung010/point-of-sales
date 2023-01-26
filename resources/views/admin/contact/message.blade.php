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
                            <h2 class="title-1">Contact Messages</h2>

                        </div>
                    </div>

                </div>


                <div class="row my-2">


                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> - {{ count($messages)}}</h4>
                    </div>
                </div>

                {{-- message alert --}}
                <div class="form-group my-3">
                    @if(session('DeleteSuccess'))
                       <div class="col-4 ">
                           <div class="alert alert-warning alert-dismissible fade show" role="alert">
                               <i class="fa-solid fa-circle-check"></i> {{ session('DeleteSuccess') }}
                               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>
                       </div>
                   @endif

               </div>
               {{-- end alert  --}}
                @if (count($messages) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody class="dataList">
                            @foreach ($messages as $m)
                                <tr>
                                    <td class="col-2"> {{ $m->name}}</td>
                                    <td class="col-2"> {{ $m->email}}</td>
                                    <td class="col-2"> {{ $m->subject}}</td>
                                    <td class="col-4"> {{ Str::words($m->message,7,'....See more')}}</td>
                                    <td class="col-2"> {{ $m->created_at->diffForHumans() }}</td>
                                    <td >
                                        <div class="table-data-feature">
                                            <a href="{{ route('admin#contactDetails',$m->id) }}" class="me-2" >
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#deleteMessage',$m->id) }}" class="col-2">
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

                <div class="row">
                    <a href="{{ route("admin#deleteAllmessages") }}" class=" col-1 offset-10 mt-3">
                        <button class="btn btn-danger">Delete All Message</button>
                    </a>
                </div>
                <div class=" my-3">
                    {{ $messages->links() }}
                </div>
                @else
                    <h4 class=" text-secondary text-center my-3">There is no message Here!</h4>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection

