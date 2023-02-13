@extends('user.layouts.master')

@section('where')
    <a class="breadcrumb-item text-dark" href="{{ route('user#profile') }}">Profile</a>
    <a class="breadcrumb-item text-dark" href="{{ route('user#editPage') }}">Edit Profile</a>
@endsection

@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content  ">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-8 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="password-center title-2 text-center">Account Profile </h3>
                        </div>
                        <hr>

                        <form action="{{ route('user#profileupdate',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 ">
                                    @if (Auth::user()->image == null)
                                         @if (Auth::user()->gender == 'male')
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{ asset('image/male.png')}}" class=" img-thumbnail rounded w-100 rounded-circle" />
                                                </a>
                                            </div>
                                        @else
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{ asset('image/female.jpg')}}" class=" img-thumbnail rounded w-100 rounded-circle" />
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('storage/img/user/'.Auth::user()->image ) }}" class=" img-thumbnail rounded w-100" />
                                            </a>
                                        </div>
                                    @endif

                                    <div class="my-2">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="" >

                                        @error('image')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>

                                    <div class="my-2 ">
                                        <button class="w-100 btn btn-dark text-white" type="submit">
                                            <i class="fa-solid fa-circle-arrow-up me-2"></i> Update
                                        </button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Name</label>
                                        <input id="" name="name"  value="{{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                        @error('name')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Email</label>
                                        <input id="" name="email"  value="{{ old('email',Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                        @error('email')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Phone</label>
                                        <input id="" name="phone"  value="{{ old('phone',Auth::user()->phone) }}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                        @error('phone')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                                            <option value="">Choose your gender..</option>
                                            <option value="male" @if(Auth::user()->gender == 'male') selected @endif >Male</option>
                                            <option value="female" @if(Auth::user()->gender == 'female') selected @endif> Female</option>
                                        </select>
                                        @error('gender')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Address</label>
                                        <input type="text" name="address" value="{{ old('address',Auth::user()->address) }}" class="form-control @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Address...">
                                        @error('address')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Facebook URL</label>
                                        <input type="text" name="facebook_url" value="{{ old('facebook_url',Auth::user()->facebookURL) }}" class="form-control @error('facebook_url') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter facbook URL...">
                                        @error('address')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Twitter URL</label>
                                        <input type="text" name="twitter_url" value="{{ old('twitter_url',Auth::user()->twitterURL) }}" class="form-control @error('twitter_url') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter twitter URL...">
                                        @error('address')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Instagram URL</label>
                                        <input type="text" name="instagram_url" value="{{ old('instagram_url',Auth::user()->instagramURL) }}" class="form-control @error('instagram_url') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter instagram_url...">
                                        @error('address')
                                            <small class=" invalid-feedback">{{ $message}}</small>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
