@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="#">Favourite</a>
@endsection

@section('content')

    @if(Auth::check())
        @if (count($favProducts) !== 0)
            <div class="">
                <div class=" d-flex flex-wrap  justify-content-center  w-75" style="" id="products">
                    @foreach ($favProducts as $favProduct)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="currentProduct">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <input type="hidden" name="productId" id="productId" value="{{ $favProduct->id }}">
                                <img class="img-fluid w-100 object-cover " id="currentImg" style="height: 300px;" src="{{ asset('storage/img/product/'.$favProduct->image) }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetail',$favProduct->id) }}" ><i class="fa-solid fa-info"></i></a>
                                    @if (count($favProducts) > 0)
                                        @for ($i = 0; $i < count($favProducts); $i++)
                                            @if ($favProducts[$i]->product_id === $favProduct->id)
                                                <a class="btn btn-outline-dark btn-square"  id="heartBtn" >
                                                    <i class="fa-solid fa-heart"></i>
                                                </a>
                                            @endif
                                        @endfor
                                        @if (!$favProducts->pluck('product_id')->contains($favProduct->id))
                                            <a class="btn btn-outline-dark btn-square"  id="heartBtn" >
                                                <i class="far fa-heart"></i>
                                            </a>
                                        @endif
                                    @else
                                        <a class="btn btn-outline-dark btn-square"  id="heartBtn" >
                                            <i class="far fa-heart"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="{{ route('user#productDetail',$favProduct->id) }}">{{ $favProduct->name }}</a>
                                <div class="d-flex flex-column align-items-center justify-content-center mt-2">
                                    @if (!empty($favProduct->discount_price))
                                        <div class=" d-flex ">
                                            <h5>{{ $favProduct->discount_price }} Kyats</h5>
                                            <h6 class="text-muted ml-2">
                                                <del>{{ $favProduct->price }} Kyats</del>
                                            </h6>
                                        </div>
                                        <span>({{ $favProduct->discount_percentage }} % OFF)</span>
                                    @else
                                        <h5>{{ $favProduct->price }} Kyats</h5><h6 class="text-muted ml-2"></h6>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    @if ($favProduct->rating_average !== null)
                                        <span>{{ $favProduct->rating_average }}
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </span>
                                    @else
                                        <span>0
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class=" text-center">
                <p class="text-center fs-2 p-5">There is no Favourite Products ;'( </p>
                <a href="{{ route('user#home') }}" class=" btn btn-primary">Add To Favourite</a>
            </div>
        @endif
    @else
        <a class="btn btn-outline-dark btn-square"  data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="far fa-heart"></i></a>
    @endif

@endsection

@section('scriptSource')
<script>
    document.addEventListener('click',function (e) {
        if(e.target.matches('#heartBtn')){
            const currentProduct = e.target.closest('#currentProduct');
            const productId = currentProduct.querySelector('#productId').value;

            const data = {
                'productId' : productId,
            }
            axios.post('removeFromFav',  {
                params: data
            })
            .then(function ({data}) {
                // console.log(data.event);
                if(data.event === true){
                    currentProduct.remove();
                }

            })
            .catch(function (error) {
            console.log(error);
            });
        }
    })
</script>
@endsection
