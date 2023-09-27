@extends('frontend.layouts.master')


@section('navigation')
    @include('frontend.partials.navigation',$categories)
@endsection

@section('content')
    @foreach ($posts as $post)
        <div class="card post-item bg-transparent border-0 mb-5">
            <a href="post-details.html">
                <img class="card-img-top rounded-0" src="img/post/post-lg/01.png" alt="">
            </a>
            <div class="card-body px-0">
                <h2 class="card-title">
                    <a class="text-white opacity-75-onHover" href="{{route('post.show',$post->slug)}}">{{ $post->title }}</a>
                </h2>
                <ul class="post-meta mt-3">
                    <li class="d-inline-block mr-3">
                        <span class="fas fa-clock text-primary"></span>
                        <a class="ml-1" href="#" dir="rtl">
                            {{ verta($post->created_at)->formatDifference() }}
                        </a>
                    </li>
                    <li class="d-inline-block">
                        <span class="fas fa-list-alt text-primary"></span>
                        @foreach ($post->categories as $key=>$category)
                            @if($key != 0)<b class="text-primary mx-1">-</b>@endif
                            <a class="ml-1" href="#">
                                {{ $category->title }}
                            </a>
                        @endforeach
                    </li>
                </ul>
                <div class="d-flex flex-row p-2 align-items-center" style="gap:10px; text-align: right; direction: rtl">
                    @if (@$post->photos[0])
                        <img src=" {{ asset($post->photos[0]->path) }}" style="min-width:128px;width:128px;height:128px;" class="rounded-circle" />
                    @else
                        <img src="{{ asset('img/default.jpg') }}" style="min-width:128px;width:128px;height:128px;" class="rounded-circle">
                    @endif
                    <p class="card-text my-4">
                        {{ Str::limit($post->body, 250, '...') }}
                    </p>
                </div>
                <a  href="{{route('post.show',$post->slug)}}" class="btn btn-primary"><strong>ادامه مطلب</strong><img src="img/arrow-right.png"
                        alt=""></a>
            </div>
        </div>
        <!-- end of post-item -->
    @endforeach
    {{ $posts->links() }}
@endsection
