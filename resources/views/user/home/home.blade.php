@extends('user.layouts.master')


@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


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

                    <form action=""  method="get" >
                        @foreach ($categories as $category)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-start gap-3 mb-2 ">
                                <input type="checkbox" class=" form-check-input checkboxFilter" name="category_id" id="{{ $category->id }}" value="{{ $category->id }}"  >
                                <span class=" ms-2" for="price-1">{{ $category->name }}</span>
                            </div>
                        @endforeach
                    </form>


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
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                   </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                   </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
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
                                    <a class="dropdown-item" href="#">Latest</a>
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
                        <a href="#" >
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100 object-cover" style="height: 200px;" src="{{ asset('storage/img/product/'.$product->image) }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="" ><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="" ><i class="far fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $product->price }} Kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                        <div class=" mt-3">
                                            <button class="btn btn-primary">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                <div class="">
                    <p class="text-center fs-2 p-5">There is no pizza ;'(<i class="fa-solid fa-pizza-slice ms-3"></i> </p>
                </div>
                @endif
            </div>
        </div>
        <!-- Shop Product End -->

    </div>
</div>
<!-- Shop End -->
@endsection

@section('scriptSource')
 <script>

    const checkboxes = document.querySelectorAll('.checkboxFilter')
    const formCheckbox = document.querySelector('form');
    const productList = document.querySelector('#products');
    const allCategories = document.querySelector('.allCategories');

    let selectedCategoryIds = [];
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change',function(){
            if(checkbox.checked) {
                selectedCategoryIds.push(checkbox.value);
            }else{
                selectedCategoryIds = selectedCategoryIds.filter(id => id !== checkbox.value);
            }

            if(selectedCategoryIds.length > 0){

                const data = {
                    'categoryId' : selectedCategoryIds,
                }

                axios.get('filter/category',  {
                    params: data
                  })
                  .then(function (response) {
                    productList.classList.remove('justify-content-center','align-items-center');
                    let list = ``;
                    for (let i = 0; i <  response.data.length; i++) {
                        list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100 object-cover" style="height: 200px;" src="{{ asset('storage/img/product/${response.data[i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href="" ><i class="fa fa-shopping-cart"></i></a>
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
                                        <button class="btn btn-primary">Add to Cart</button>
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

            if(selectedCategoryIds.length === 0){
                productList.classList.add('justify-content-center','align-items-center');
                productList.innerHTML = `<p class="text-center fs-2 p-5">There is no pizza ;'(<i class="fa-solid fa-pizza-slice ms-3"></i> </p>`;
            }

        })
    })


    allCategories.addEventListener('change',function(){
        let allSelectCategories = [];
        // checkboxes.forEach((i) => {
        //     let result = i.hasAttribute('checked')
        //     console.log(result);
        //     if(result === false){
        //         i.setAttribute('checked',true);
        //     }
        // } );

        for (let i = 0; i < checkboxes.length; i++) {
            let result = checkboxes[i].hasAttribute('checked');
            console.log(result);
            checkboxes[i].toggleAttribute('checked')
            allSelectCategories.push(checkboxes[i].value)
        }

        const data = {
            'categoryId' : allSelectCategories,
        }

        axios.get('filter/category',  {
            params: data
          })
          .then(function (response) {
            productList.classList.remove('justify-content-center','align-items-center');
            let list = ``;
            for (let i = 0; i <  response.data.length; i++) {
                list += `
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100 object-cover" style="height: 200px;" src="{{ asset('storage/img/product/${response.data[i].image}') }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="" ><i class="fa fa-shopping-cart"></i></a>
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
                                <button class="btn btn-primary">Add to Cart</button>
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

    })

</script>



@endsection
