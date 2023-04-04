@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#productDetail',$product->id) }}">Product Detail</a>
@endsection

@section('css')
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 1em;
        font-size: 30px;
        font-weight: 300;
        color: #FFD600;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4
    }

</style>
@endsection

@section('content')

<!-- Shop Detail Start -->
<div class="container-fluid pb-5">

    <button  onclick="history.back()" class="btn btn-primary my-2 ms-5 me-2 text-white">
        <i class="fa-solid fa-arrow-left fs-5"></i> <span class="fs-6">Back</span>
    </button>
    <div class="row justify-content-end me-5">
        <div class="col-6 alertContainer d-none">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong class="alert-pusher"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide " data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 object-cover" style="height: 500px" src="{{ asset('storage/img/product/'.$product->image )}}" alt="Image">
                    </div>

                </div>
                {{-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a> --}}
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{ $product->name}}</h3>
                {{-- <input type="hidden" value="{{ Auth::user()->id }}" id="userId"> --}}
                @if(Auth::check())
                    <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                @else
                    <input type="hidden" value="0" id="userId">
                @endif
                <input type="hidden" value="{{ $product->id }}" id="productId">
                @if(isset($averageRatingNumber))
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            {{-- @for ($i = 0 ; $i <  round($averageRatingNumber) ; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor --}}
                            @for ($i = 0; $i < round($averageRatingNumber); $i++)
                                @if ($i < 5)
                                    <i class="fa-solid fa-star"></i>
                                @endif
                            @endfor
                            @if ($averageRatingNumber < 5)
                                @if ($averageRatingNumber === 0.5 ||$averageRatingNumber === 1.5 || $averageRatingNumber === 2.5 || $averageRatingNumber === 3.5 || $averageRatingNumber === 4.5 )
                                    @for ($i = 0 ; $i <  round(5 - $averageRatingNumber)- 1  ; $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                @else
                                    @for ($i = 0 ; $i <  round(5 - $averageRatingNumber)  ; $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                @endif
                            @endif
                        </div>
                        <span>({{ $averageRatingNumber }})</span>
                    </div>
                @endif

                <p class="pt-1">{{ $product->view_count + 1 }} <i class="fa-regular fa-eye ms-2"></i></p>

                @if (!empty($product->discount_price))
                    <h3 class="font-weight-semi-bold mb-4">{{ $product->discount_price}} Kyats <small><del>{{ $product->price }} Kyats</del></small></h3>
                @else
                    <h3 class="font-weight-semi-bold mb-4">{{ $product->price}} Kyats</h3>
                @endif
                <p class="mb-4"> {{ $product->description }}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" id="btnMinus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" id="orderCount" class="form-control bg-secondary border-0 text-center"  value="1" min="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus" id="btnPlus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    @if(Auth::check())
                        <button type="button" id="addToCart" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>
                            Add To
                            Cart
                        </button>
                    @else
                        <button type="button" id="addToCart" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-shopping-cart mr-1"></i>
                            Add To
                            Cart
                        </button>
                    @endif

                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
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

<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($products as $p )
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/img/product/'.$p->image )}}" style="height: 200px" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetail',$p->id) }}" ><i class="fa-solid fa-info"></i></a>
                                {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a> --}}
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{ route('user#productDetail',$p->id) }}">{{ $p->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{ $p->price }} kyats</h5>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-1">
                                @if ($p->rating_average !== null)
                                    <span>{{ $p->rating_average }}
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
                @endforeach

            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<div class="row px-xl-5">
    <div class="col">
        <div class="bg-light p-30">
            <div class="nav nav-tabs mb-4">
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews ( {{ count($ratings) }})</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                    <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3">Additional Information</h4>
                    <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                </li>
                                <li class="list-group-item px-0">
                                    Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                </li>
                                <li class="list-group-item px-0">
                                    Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                </li>
                                <li class="list-group-item px-0">
                                    Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                </li>
                              </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                </li>
                                <li class="list-group-item px-0">
                                    Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                </li>
                                <li class="list-group-item px-0">
                                    Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                </li>
                                <li class="list-group-item px-0">
                                    Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                </li>
                              </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">{{ count($ratings) }} reviews for "{{ $product->name}}"</h4>
                            <div class="media mb-4 d-flex flex-column">
                                {{-- <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;"> --}}
                                <div class="" >
                                        <div id="reviewContainer">

                                        </div>
                                    @if($ratings)
                                        @foreach ($ratings as $rating )
                                            <div class="media-body" >
                                                <h6>{{ $rating->username }}<small> - <i>{{ $rating->created_at->diffForHumans() }}</i></small></h6>
                                                <div class="text-primary mb-2">
                                                    @for ($i = 0 ; $i < $rating->rating_status ; $i++)
                                                        <i class="fa-solid fa-star"></i>
                                                    @endfor
                                                </div>
                                                <p>{{ $rating->message }}</p>
                                            </div>
                                        @endforeach

                                        {{-- <div class=" my-3">
                                            {{ $ratings->links() }}
                                        </div> --}}
                                    @endif
                                </div>
                                <div class="">
                                    <a href="#">View more reviews</a>
                                </div>


                            </div>
                        </div>
                        {{-- modal box for no user  --}}
                        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up </h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  To write reviews,Login Need!.
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <a href="{{ route('registerPage') }}" type="button"  class="btn btn-primary">Sign Up</a>
                                </div>
                              </div>
                            </div>
                          </div>

                        <div class="col-md-6">
                            <div class=" d-flex flex-column ">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="d-flex flex-column justify-content-start my-3">
                                    <p class="mb-0 mr-2">Rate Stars</p>
                                    <div class="rating">
                                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>

                                    @if(Auth::check())
                                        <div class="form-group mb-0">
                                            <button type="button" class="btn btn-primary px-3" id="review-submit">Leave Your Review</button>
                                        </div>
                                    @else
                                        <div class="form-group mb-0" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                            <button type="button" class="btn btn-primary px-3" id="review-submit">Leave Your Review</button>
                                        </div>
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('scriptSource')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    const addToCart = document.querySelector('#addToCart');
    const productId = document.querySelector('#productId').value;
    const orderCount = document.querySelector('#orderCount');
    const reviewContainer = document.querySelector('#reviewContainer');

    axios.get('/user/viewCount',  {
        params: {'productId' : productId}
    })
    .then(function (response) {
    console.log(response);

    })
    .catch(function (error) {
    console.log(error);
    });

    addToCart.addEventListener('click',function(){
        const userId = document.querySelector("#userId").value;
        if(userId !== 0){
            const data = {
                'productId' : productId,
                'orderCount' : orderCount.value,
            }
            axios.get('/user/addCountCart',  {
                params: data
            })
            .then(function (response) {
            console.log(response);

            })
            .catch(function (error) {
            console.log(error);
            });
        }
    })

    const reviewBtn = document.querySelector('#review-submit');
    const message = document.querySelector('#message');
    const radios = document.querySelectorAll('input[name="rating"]');

    reviewBtn.addEventListener('click', function() {
      const selectedRadio = document.querySelector('input[name="rating"]:checked');
      if (selectedRadio && message.value) {
        const data = {
            'ratingCount' : selectedRadio.value,
            'message' : message.value,
            'productId' : productId
        }

        console.log(data);

        axios.post('/user/review',  {
            data
        })
        .then(function (response) {
            console.log(response.data);
            if(response.data){
                const ratingStars = response.data['rating_status'];
                const starsHTML = Array.from({ length: ratingStars }, () => `
                    <i class="fa-solid fa-star"></i>
                `).join('');

                const formatDate = moment(response.data['created_at']).startOf('second').fromNow();
                reviewContainer.innerHTML += `
                <div class="media-body" >
                    <h6>${response.data['user_id']}<small> - <i>${formatDate}</i></small></h6>
                    <div class="text-primary mb-2">
                        ${starsHTML}
                    </div>
                    <p>${response.data['message']}</p>
                </div>
                `;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
      }
    });

</script>
@endsection









