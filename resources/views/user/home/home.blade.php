@extends('user.layouts.master')

@section('CART')

@if (Auth::user())
<div class="navbar-nav ml-auto py-0  d-lg-block ">
    <a href="{{ route('user#favLists') }}" class="btn px-0 @if(Route::currentRouteName() == 'user#favLists') text-primary @else text-white @endif ">
        <i class="fas fa-heart "></i>
        <span class="badge text-secondary border border-secondary rounded-circle" id='favCount' style="padding-bottom: 2px;">{{ count($favProducts) }}</span>
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
                        <input type="checkbox" value="" class="form-check-input allCategories" name="category-all"  id="allCategories">
                        <label class="" for="allCategories">All Categories</label>
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
            {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input"  id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">0 - 1000  Kyats</label>
                   </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">1000 - 10000 Kyats</label>
                   </div>
                   <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-3">10000 - 100000 Kyats</label>
                    </div>
                </form>
            </div> --}}
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
                                    <a class="dropdown-item" href="#" class="popularitySort " id="popularitySort">Popularity</a>
                                    <a class="dropdown-item" href="#" class="ratingSort " id="ratingSort">Best Rating</a>
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
                                        @if(Auth::check())
                                            @if (count($favProducts) > 0)
                                                @for ($i = 0; $i < count($favProducts); $i++)
                                                    @if ($favProducts[$i]->product_id === $product->id)
                                                        <a class="btn btn-outline-dark btn-square"  id="heartBtn" >
                                                            <i class="fa-solid fa-heart"></i>
                                                        </a>
                                                    @endif
                                                @endfor
                                                @if (!$favProducts->pluck('product_id')->contains($product->id))
                                                    <a class="btn btn-outline-dark btn-square"  id="heartBtn" >
                                                        <i class="far fa-heart"></i>
                                                    </a>
                                                @endif
                                            @else
                                                <a class="btn btn-outline-dark btn-square"  id="heartBtn" >
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a class="btn btn-outline-dark btn-square"  data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="far fa-heart"></i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="{{ route('user#productDetail',$product->id) }}">{{ $product->name }}</a>
                                    <div class="d-flex flex-column align-items-center justify-content-center mt-2">
                                        @if (!empty($product->discount_price))
                                            <div class=" d-flex ">
                                                <h5>{{ $product->discount_price }} Kyats</h5>
                                                <h6 class="text-muted ml-2">
                                                    <del>{{ $product->price }} Kyats</del>
                                                </h6>
                                            </div>
                                            <span>({{ $product->discount_percentage }} % OFF)</span>
                                        @else
                                            <h5>{{ $product->price }} Kyats</h5><h6 class="text-muted ml-2"></h6>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        {{-- <h5>{{ $product->rating_average }}</h5> --}}
                                        @if ($product->rating_average !== null)
                                            <span>{{ $product->rating_average }}
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </span>
                                        @else
                                            <span>0
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </span>
                                        @endif
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

  <div class="modal fade" id="favModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          To add Favourite Products,Sign Up Now!.
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
    <script src="{{ asset('js/script.js') }}" ></script>
@endif

 <script>
    const checkboxes = document.querySelectorAll('.checkboxFilter')
    const formCheckbox = document.querySelector('form');
    const productList = document.querySelector('#products');
    const allCategories = document.querySelector('.allCategories');
    const lastestSort = document.querySelector('#lastestSort');
    const ratingSort = document.querySelector('#ratingSort');
    const popularitySort = document.querySelector('#popularitySort');

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
                                        <img class="img-fluid w-100 object-cover" id="currentImg" style="height: 300px;" src="{{ asset('storage/img/product/${response.data[i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="product/detail/${response.data[i].id}" ><i class="fa-solid fa-info"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="" ><i class="far fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="product/detail/${response.data[i].id}">${response.data[i].name}</a>
                                        <div class=" ${response.data[i].discount_price ? 'd-flex flex-column align-items-center justify-content-center mt-2' : 'd-none ' }">
                                            <div class='d-flex'>
                                                <h5>${ response.data[i].discount_price } Kyats</h5>
                                                <h6 class="text-muted ml-2">
                                                    <del>${response.data[i].price} Kyats</del>
                                                </h6>
                                            </div>
                                            <span>(${ response.data[i].discount_percentage } % OFF)</span>
                                        </div>
                                        <div class=" ${response.data[i].discount_price ?  'd-none'  : 'd-flex align-items-center justify-content-center mt-2'}">
                                            <h5>${ response.data[i].price } Kyats</h5><h6 class="text-muted ml-2"></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <span>${response.data[i].rating_average ? response.data[i].rating_average: 0}
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </span>
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
            axios.get('filter/allCategories',  {
                params: data
              })
              .then(function (response) {
                console.log(response);
                productList.classList.remove('justify-content-center','align-items-center');
                let list = ``;
                for (let i = 0; i <  response.data.length; i++) {
                    list += `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="currentProduct">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <input type="hidden" name="productId" id="productId" value='${response.data[i].id}'>
                                <img class="img-fluid w-100 object-cover" id="currentImg" style="height: 300px;" src="{{ asset('storage/img/product/${response.data[i].image}') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="product/detail/${response.data[i].id}" ><i class="fa-solid fa-info"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="" ><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="product/detail/${response.data[i].id}">${response.data[i].name}</a>
                                <div class=" ${response.data[i].discount_price ? 'd-flex flex-column align-items-center justify-content-center mt-2' : 'd-none ' }">
                                    <div class='d-flex'>
                                        <h5>${ response.data[i].discount_price } Kyats</h5>
                                        <h6 class="text-muted ml-2">
                                            <del>${response.data[i].price} Kyats</del>
                                        </h6>
                                    </div>
                                    <span>(${ response.data[i].discount_percentage } % OFF)</span>
                                </div>
                                <div class=" ${response.data[i].discount_price ?  'd-none'  : 'd-flex align-items-center justify-content-center mt-2'}">
                                    <h5>${ response.data[i].price } Kyats</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <span>${response.data[i].rating_average ? response.data[i].rating_average: 0}
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </span>
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
        sortFun();
    })
    const sortFun = () =>{
        axios.get('sort/products',  {
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
                            <img class="img-fluid w-100 object-cover" id="currentImg" style="height: 300px;" src="{{ asset('storage/img/product/${response.data[i].image}') }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="product/detail/${response.data[i].id}" ><i class="fa-solid fa-info"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="" ><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="product/detail/${response.data[i].id}">${response.data[i].name}</a>
                            <div class=" ${response.data[i].discount_price ? 'd-flex flex-column align-items-center justify-content-center mt-2' : 'd-none ' }">
                                <div class='d-flex'>
                                    <h5>${ response.data[i].discount_price } Kyats</h5>
                                    <h6 class="text-muted ml-2">
                                        <del>${response.data[i].price} Kyats</del>
                                    </h6>
                                </div>
                                <span>(${ response.data[i].discount_percentage } % OFF)</span>
                            </div>
                            <div class=" ${response.data[i].discount_price ?  'd-none'  : 'd-flex align-items-center justify-content-center mt-2'}">
                                <h5>${ response.data[i].price } Kyats</h5><h6 class="text-muted ml-2"></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <span>${response.data[i].rating_average ? response.data[i].rating_average: 0}
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </span>
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

    //popularity sort
    popularitySort.addEventListener('click',function() {
        data = {
            'sortType' : 'popularitySort',
        }
        sortFun();
    })

    //ratingSort sort
    ratingSort.addEventListener('click',function() {
        data = {
            'sortType' : 'ratingSort',
        }
        sortFun();
    })

    let favCount = document.querySelector('#favCount');

    document.addEventListener('click',function (e) {
        if(e.target.matches('#heartBtn')){
            const currentProduct = e.target.closest('#currentProduct');
            const productId = currentProduct.querySelector('#productId').value;

            let favAmount = document.querySelector('#favCount').innerHTML * 1;
            const data = {
                'productId' : productId,
            }
            axios.post('addToFav',  {
                params: data
            })
            .then(function ({data}) {
                if(data.event === false){
                    const FavBtn = currentProduct.querySelector('#heartBtn');
                    FavBtn.innerHTML = '<i class="far fa-heart"></i>';
                    favCount.innerHTML =  favAmount -1 ;

                }else{
                    const FavBtn = currentProduct.querySelector('#heartBtn');
                    FavBtn.innerHTML = '<i class="fa-solid fa-heart"></i>';
                    favCount.innerHTML =  favAmount + 1;
                }

                Pusher.logToConsole = true;

                var pusher = new Pusher('cf619290d4af27a2387f', {
                  cluster: 'ap1'
                });

                const favCh = pusher.subscribe('my-fav');
                favCh.bind('fav_event', function(Edata) {
                const result = JSON.stringify(Edata);
                    //fav event
                    console.log(Edata.message);
                    console.log(data.event);

                });

            })
            .catch(function (error) {
            console.log(error);
            });
        }
    })
</script>

@endsection
