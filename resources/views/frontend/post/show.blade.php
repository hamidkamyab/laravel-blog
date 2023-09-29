@extends('frontend.layouts.master')

@section('meta')
    <meta name="description" content="{{ $post->meta_description }}">
    <meta name="keywords" content="{{ $post->meta_keywords }}">
    <meta name="author" content="{{ $post->user->name }}">
@endsection

@section('navigation')
    @include('frontend.partials.navigation', $categories)
@endsection

@section('content')
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
                <img src="{{ asset($post->photos[0]->path) }}" class="img-fluid" />
            </div>

            <p dir="rtl" class="mb-4" style="text-align:justify; font-size: 18px;">
                {{ $post->body }}
            </p>



            <div class="widget" style="text-align:justify;" dir="rtl">
                @if (Session::has('add_comment'))
                    <div class="alert alert-success">
                        <div>
                            {{ Session('add_comment') }}
                        </div>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div><span>{{ $error }}</span></div>
                        @endforeach
                    </div>
                @endif
                <h2 class="widget-title text-white d-inline-block mb-4">دیدگاه</h2>
                <div class="col-12">
                    <form action="{{ route('comment.store') }}" method="Post">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        <div class="form-group">
                            <label for="nameInput" style="font-weight: 700">نام:</label>
                            <input type="text" class="form-control bg-dark-800" id="nameInput" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group">
                            <label for="emailInput" style="font-weight: 700">ایمیل:</label>
                            <input type="email" class="form-control bg-dark-800" id="emailInput" name="email" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group">
                            <label for="bodyInput" style="font-weight: 700">متن دیدگاه</label>
                            <textarea class="form-control bg-dark-800 h-auto" id="bodyInput" name="body" rows="10">{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-outline-red" style="letter-spacing: 0em;font-weight: bold"
                                type="submit">ثـبـت نـظـر</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
