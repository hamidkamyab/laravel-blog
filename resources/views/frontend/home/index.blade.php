@extends('frontend.layouts.master')

@section('content')
    @foreach ($posts as $post)
        <div class="card post-item bg-transparent border-0 mb-5">
            <a href="post-details.html">
                <img class="card-img-top rounded-0" src="img/post/post-lg/01.png" alt="">
            </a>
            <div class="card-body px-0">
                <h2 class="card-title">
                    <a class="text-white opacity-75-onHover" href="post-details.html">{{ $post->title }}</a>
                </h2>
                <ul class="post-meta mt-3">
                    <li class="d-inline-block mr-3">
                        <span class="fas fa-clock text-primary"></span>
                        <a class="ml-1" href="#">
                            {{ verta($post->created_at) }}
                        </a>
                    </li>
                    <li class="d-inline-block">
                        <span class="fas fa-list-alt text-primary"></span>
                        @foreach ($post->categories as $category)
                            <a class="ml-1" href="#">
                                {{ $category->title }}
                            </a>
                        @endforeach
                    </li>
                </ul>
                <p class="card-text my-4">
                    {{ Str::limit($post->body, 250, '...') }}
                </p>
                <a href="post-details.html" class="btn btn-primary">Read More <img src="img/arrow-right.png"
                        alt=""></a>
            </div>
        </div>
        <!-- end of post-item -->
    @endforeach
    {{$posts->links()}}
@endsection

