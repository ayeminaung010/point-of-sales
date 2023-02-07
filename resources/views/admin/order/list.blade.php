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
                        <h4> <i class="fa-solid fa-database ms-2"></i> - {{ count($orders) }}</h4>
                    </div>
                </div>

                <form action="" method="post">
                    @csrf
                    <label for="orderStatus" class=" text-dark text-bold">Filter Orders</label>
                    <div class="input-group mb-3 ">
                        <select name="orderStatus" id="orderStatus" class="form-control col-2">
                            <option value="">All</option>
                            <option value="0" @if(request('orderStatus') == '0' ) selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus') == '1' ) selected @endif>Success</option>
                            <option value="2" @if(request('orderStatus') == '2' ) selected @endif>Reject</option>
                        </select>

                    </div>
                </form>

                <div class="table-responsive table-responsive-data2">
                @if ( count($orders) !== 0)
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
                    <tbody class="lists">
                        @foreach ($orders as $order )
                        <tr class="tr-shadow dataList">
                            <input type="hidden" class="orderId" value="{{ $order->id }}">
                            <td>{{ $order->user_id}}  </td>
                            <td>{{ $order->username}}  </td>
                            <td>{{ $order->created_at->format('F j, Y')}}  </td>
                            <td>
                                <a href="{{ route('admin#userOrderLists',$order->order_code) }}" class="orderCode">{{ $order->order_code}}</a>
                            </td>
                            <td class="amount">{{ $order->total_price}} kyats </td>
                            <td>
                                <select name="status" class="form-control statusChange" id="">
                                    <option value="0" @if($order->status == 0) selected @endif >Pending</option>
                                    <option value="1" @if($order->status == 1) selected @endif>Success</option>
                                    <option value="2" @if($order->status == 2) selected @endif>Reject</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="">
                    <p class="text-center fs-2 p-5">There is no Orders ;'( </p>
                </div>
                @endif

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
<script>
    const statusChanges = document.querySelectorAll('.statusChange');
    // statusChanges.forEach((statusChange) => {
    //     statusChange.addEventListener('change',function(e){
    //         const dataList = e.target.closest('.dataList');
    //         const statusValue = e.target.value
    //         const orderCode = dataList.querySelector('.orderCode').innerHTML;

    //         const data = {
    //             'status' : statusValue,
    //             'order_code' : orderCode
    //         }
    //         console.log(data);
    //         axios.get('/admin/order/statusChange',  {
    //             params: data
    //         })
    //         .then(function (response) {
    //             console.log(response);
    //         })
    //         .catch(function (error) {
    //         // handle error
    //             console.log(error);
    //         });
    //     })
    // })

    document.addEventListener('click',function(e){
        if(e.target.matches('.statusChange')){
            const dataList = e.target.closest('.dataList');
            const statusValue = e.target.value;
            const orderCode = dataList.querySelector('.orderCode').innerHTML;

            const data = {
                'status' : statusValue,
                'order_code' : orderCode
            }
            console.log(data);
            axios.get('/admin/order/statusChange',  {
                params: data
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
            // handle error
                console.log(error);
            });
        }
    })


    const orderStatus = document.querySelector('#orderStatus');
    const lists = document.querySelector('.lists');
    orderStatus.addEventListener('change',function(){
        const data = {
            'orderStatus' : orderStatus.value,
        }
        console.log(data);
        axios.get('/admin/order/filterOrder',  {
            params: data
        })
        .then(function (response) {
            console.log(response.data);
            let list = '';
            if(response.data.length === 0){
                lists.innerHTML = `
                <div class="">
                    <p class="text-center fs-2 p-5">There is no Orders ;'( </p>
                </div>`
            }else{
                for (let i = 0; i < response.data.length; i++) {
                    let date = new Date(response.data[i]['created_at']);
                    let options = { year: 'numeric', month: 'long', day: 'numeric' };
                    let formattedDate = date.toLocaleDateString('en-US', options);

                    list += `
                    <tr class="tr-shadow dataList">
                        <input type="hidden" class="orderId" value="${response.data[i]['id']}">
                        <td>${response.data[i]['user_id']}  </td>
                        <td>${response.data[i]['username']}  </td>
                        <td>${formattedDate}  </td>
                        <td>
                            <a href="orders-details/${response.data[i]['order_code']}" class="orderCode">${response.data[i]['order_code']}</a>
                        </td>
                        <td class="amount">${response.data[i]['total_price']} kyats </td>
                        <td>
                            <select name="status" class="form-control statusChange" id="">
                                <option value="0" ${response.data[i]['status'] === 0 ? 'selected' : ''} >Pending</option>
                                <option value="1" ${response.data[i]['status'] === 1 ? 'selected' : ''} >Success</option>
                                <option value="2" ${response.data[i]['status'] === 2 ? 'selected' : ''} >Reject</option>
                            </select>
                        </td>
                    </tr>
                    `;
                    lists.innerHTML = list;
                }
            }
        })
        .catch(function (error) {
        // handle error
            console.log(error);
        });
    })

</script>
@endsection

