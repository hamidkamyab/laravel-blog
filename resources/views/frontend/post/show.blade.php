@extends('frontend.layouts.master')

@section('navigation')
    @include('frontend.partials.navigation',$categories)
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <form class="search-form" action="#">
                <div class="input-group">
                    <input type="search" class="form-control bg-transparent shadow-none rounded-0" placeholder="Search here">
                    <div class="input-group-append">
                        <button class="btn" type="submit">
                            <span class="fas fa-search"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-lg-10">
            <h3 class="text-white add-letter-space mt-4" dir="rtl" style="text-align:right;">{{ $post->title }}</h3>
            <ul class="post-meta mt-3 mb-4" dir="rtl" style="text-align:right;">
                <li class="d-inline-block ml-3">
                    <span class="fas fa-clock text-primary"></span>
                    <a class="ml-1" href="#">{{ verta($post->created_at) }}</a>
                </li>
                <li class="d-inline-block">
                    <span class="fas fa-list-alt text-primary"></span>
                    @foreach ($post->categories as $key => $category)
                        @if ($key != 0)
                            <b class="text-primary mx-1">-</b>
                        @endif
                        <a class="ml-1" href="#">
                            {{ $category->title }}
                        </a>
                    @endforeach
                </li>
            </ul>

            <div class=" my-2">
                <img src="{{asset($post->photos[0]->path)}}" class="img-fluid"  />
            </div>

            <p dir="rtl" class="mb-4" style="text-align:justify; font-size: 18px;">
                {{$post->body}}
            </p>



            <div class="widget"  style="text-align:justify;" dir="rtl" >
                <h2 class="widget-title text-white d-inline-block mb-4">دیدگاه</h2>

                <div class="col-12">
                    <form>
                        <div class="form-group">
                            <label for="nameInput" style="font-weight: 700">نام:</label>
                            <input type="text" class="form-control bg-dark-800" id="nameInput" />
                        </div>
                        <div class="form-group">
                            <label for="emailInput" style="font-weight: 700">ایمیل:</label>
                            <input type="email" class="form-control bg-dark-800" id="emailInput" />
                        </div>
                        <div class="form-group">
                            <label for="bodyInput" style="font-weight: 700">متن دیدگاه</label>
                            <textarea class="form-control bg-dark-800 h-auto" id="bodyInput" rows="10" ></textarea>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
