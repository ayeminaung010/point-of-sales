@extends('user.layouts.master')

@section('CART')

@if (Auth::user())
<div class="navbar-nav ml-auto py-0  d-lg-block ">
    <a href="" class="btn px-0 ">
        <i class="fas fa-heart text-primary"></i>
        <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
    </a>
    <a href="{{ route('user#cart') }}" id="cart" class="btn px-0 ml-3 animate__animated   @if(Route::currentRouteName() == 'user#cart') text-primary @else text-white @endif">
        <i class="fas fa-shopping-cart "></i>
        <span class="badge text-secondary border border-secondary rounded-circle" id='cartAmount' style="padding-bottom: 2px;">{{ count($carts) }}</span>
    </a>
    <a href="{{ route('user#orderHistory',Auth::user()->id) }}" id="cart" class="btn px-0 ml-3 animate__animated   @if(Route::currentRouteName() == 'user#orderHistory') text-primary @else text-white @endif">
        <div class="">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>History</span>
            <span class="badge text-secondary border border-secondary rounded-circle" id='cartAmount' style="padding-bottom: 2px;">{{ count($orders) }}</span>
        </div>
    </a>
</div>
@endif

@endsection

@section('content')

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Category Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" value="" class="custom-control-input allCategories" name="all"  id="price-all">
                        <label class="custom-control-label" for="price-all">All Categories</label>
                    </div>

                    @foreach ($categories as $category)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-start gap-3 mb-2 ">
                        <input type="checkbox" class="form-check-input checkboxFilter " name="category_id" id="{{ $category->id }}" value="{{ $category->id }}"  >
                        <span class=" ms-2 " for="price-1">{{ $category->name }}</span>
                    </div>
                    @endforeach


                </form>
            </div>
            <!-- category End -->

            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                   </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                   </div>
                </form>
            </div>
            <!-- Price End -->

        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-end mb-4">
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" class="lastestSort " id="lastestSort">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($products) !== 0)
                    <div class=" d-flex flex-wrap " id="products">
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="currentProduct">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <input type="hidden" name="productId" id="productId" value="{{ $product->id }}">

                                    <img class="img-fluid w-100 object-cover " id="currentImg" style="height: 300px;" src="{{ asset('storage/img/product/'.$product->image) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetail',$product->id) }}" ><i class="fa-solid fa-info"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="" ><i class="far fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="{{ route('user#productDetail',$product->id) }}">{{ $product->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                    @if (!empty($product->discount_price))
                                        <h5>{{ $product->discount_price }} Kyats</h5><h6 class="text-muted ml-2"><del>{{ $product->price }} Kyats</del></h6>
                                    @else
                                    <h5>{{ $product->price }} Kyats</h5><h6 class="text-muted ml-2"></h6>
                                    @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>

                                    @if(Auth::check())
                                        <div class=" mt-3">
                                            <button class="btn btn-primary" id="addToCart">Add to Cart</button>
                                        </div>
                                    @else
                                        <div class=" mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <button class="btn btn-primary" id="addToCart">Add to Cart</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                @else
                <div class="">
                    <p class="text-center fs-2 p-5">There is no Products ;'( </p>
                </div>
                @endif
            </div>
        </div>
        <!-- Shop Product End -->

    </div>
</div>

{{-- modal box for no user  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          To Buy Products,Sign Up Now!.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="{{ route('registerPage') }}" type="button"  class="btn btn-primary">Sign Up</a>
        </div>
      </div>
    </div>
  </div>

<!-- Shop End -->
@endsection

@section('scriptSource')
@if (Auth::user())
    <script src="{{ asset('js/script.js') }}"></script>
@endif

 <script>
    const checkboxes = document.querySelectorAll('.checkboxFilter')
    const formCheckbox = document.querySelector('form');
    const productList = document.querySelector('#products');
    const allCategories = document.querySelector('.allCategories');
    const lastestSort = document.querySelector('#lastestSort');

// single checkbox
    let selectedCategoryIds = [];

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change',function(){
            if(checkbox.checked) {
                selectedCategoryIds.push(checkbox.value);
            }else{
                selectedCategoryIds = selectedCategoryIds.filter(id => id !== checkbox.value);
            }
            const data = {
                'categoryId' : selectedCategoryIds,
            }

            if(selectedCategoryIds.length > 0){
                axios.get('filter/category',  {
                    params: data
                  })
                  .then(function (response) {
                    productList.classList.remove('justify-content-center','align-items-center');
                    let list = ``;
                    if(response.data.length === 0 ){
                        productList.classList.add('justify-content-center','align-items-center');
                        productList.innerHTML = `<p class="text-center fs-2 p-5">There is no Products ;'( </p>`;
                    }else{
                        for (let i = 0; i <  response.data.length; i++) {
                            list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="currentProduct">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <input type="hidden" name="productId" id="productId" value='${response.data[i].id}'>
                                        <img class="img-fluid w-100 object-cover" id="currentImg" style="height: 200px;" src="{{ asset('storage/img/product/${response.data[i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="product/detail/${response.data[i].id}" ><i class="fa-solid fa-info"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="" ><i class="far fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response.data[i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response.data[i].price} Kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                        <div class=" mt-3">
                                            <button class="btn btn-primary" id="addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `
                        }
                        productList.innerHTML = list;
                    }
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
            }

            if(selectedCategoryIds.length === 0 ){
                productList.classList.add('justify-content-center','align-items-center');
                productList.innerHTML = `<p class="text-center fs-2 p-5">There is no Products ;'( </p>`;
            }
        })
    })

    //all categories check
    allCategories.addEventListener('change',function(){
        let allSelectCategories = [];

        checkboxes.forEach(checkbox => {
            checkbox.checked = allCategories.checked;
            if(checkbox.checked){
                allSelectCategories.push(checkbox.value);
            }else{
                allSelectCategories.filter(id => id !== checkbox.value);
            }
        });


        const data = {
            'categoryId' : allSelectCategories,
        }

        if(allSelectCategories.length > 0){
            axios.get('filter/category',  {
                params: data
              })
              .then(function (response) {
                productList.classList.remove('justify-content-center','align-items-center');
                let list = ``;
                for (let i = 0; i <  response.data.length; i++) {
                    list += `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="currentProduct">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <input type="hidden" name="productId" id="productId" value='${response.data[i].id}'>
                                <img class="img-fluid w-100 object-cover" id="currentImg" style="height: 200px;" src="{{ asset('storage/img/product/${response.data[i].image}') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="product/detail/${response.data[i].id}" ><i class="fa-solid fa-info"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="" ><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response.data[i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${response.data[i].price} Kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                                <div class=" mt-3">
                                    <button class="btn btn-primary" id="addToCart">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                }
                productList.innerHTML = list;
              })
              .catch(function (error) {
                console.log(error);
              });
        }

        if(allSelectCategories.length === 0){
            productList.classList.add('justify-content-center','align-items-center');
            productList.innerHTML = `<p class="text-center fs-2 p-5">There is no Products ;'( </p>`;
        }
    })

    //sorting
    //lastest sorting
    let data ;
    lastestSort.addEventListener('click',function(){
        data = {
            'sortType' : 'lastestSort',
        }
        console.log(data);
        lastest();
    })
    const lastest = () =>{
        axios.get('sort/products',  {
            params: data
          })
          .then(function (response) {
            console.log(response.data.length);
            productList.classList.remove('justify-content-center','align-items-center');
            let list = ``;
            for (let i = 0; i <  response.data.length; i++) {
                list += `
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="currentProduct">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <input type="hidden" name="productId" id="productId" value='${response.data[i].id}'>
                            <img class="img-fluid w-100 object-cover" id="currentImg" style="height: 200px;" src="{{ asset('storage/img/product/${response.data[i].image}') }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="product/detail/${response.data[i].id}" ><i class="fa-solid fa-info"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="" ><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">${response.data[i].name}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>${response.data[i].price} Kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                            <div class=" mt-3">
                                <button class="btn btn-primary" id="addToCart">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                `
            }
            productList.innerHTML = list;
          })
          .catch(function (error) {
            console.log(error);
          });
    }

</script>

@endsection
