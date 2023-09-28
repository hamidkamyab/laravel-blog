@extends('admin.layouts.master')

@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">لیست پست ها</h4>
    <div class="bg-white p-4">
        @if (Session::has('delete_post'))
            <div class="alert alert-success">
                <div>
                    {{Session('delete_post')}}
                </div>
            </div>
        @endif
        @if (Session::has('add_post'))
            <div class="alert alert-success">
                <div>
                    {{Session('add_post')}}
                </div>
            </div>
        @endif
        @if (Session::has('edit_post'))
            <div class="alert alert-success">
                <div>
                    {{Session('edit_post')}}
                </div>
            </div>
        @endif
        <table class="table table-hover"  style="font-size: 14px">
            <thead>
                <td>#</td>
                <td>تصویر</td>
                <td>عنوان</td>
                <td>نویسنده</td>
                <td>توضیحات</td>
                <td>دسته بندی</td>
                <td>وضعیت</td>
                <td>تاریخ ایجاد</td>
            </thead>
            <tbody>
                @foreach ($posts as $key => $post)
                    <tr>
                        <td>{{ (($posts->currentPage()-1) * 5) + ($key + 1) }}</td>
                        <td>
                            @if (@$post->photos[0])
                                <img src=" {{ asset($post->photos[0]->path) }}" width="58" height="58" />
                            @else
                                <img src="{{ asset('img/default.jpg') }}" width="58" height="58">
                            @endif
                        </td>
                        <td>
                            <a href="{{route('posts.edit',$post->id)}}">{{ Str::limit($post->title, 12, '...') }}</a>
                        </td>

                        <td>
                            {{ $post->user->name }}
                        </td>

                        <td>{{ Str::limit($post->body, 25, '...') }}</td>

                        <td>
                            @foreach ($post->categories as $category)
                                <span class="badge bg-primary">
                                    {{ $category->title }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @if ($post->status == 0)
                                <span class="badge bg-danger">
                                    منتشر نشده
                                </span>
                            @else
                                <span class="badge bg-success">
                                    منتشر شده
                                </span>
                            @endif
                        </td>
                        <td>
                            {{ verta($post->created_at)->formatDifference() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
                <td>#</td>
                <td>تصویر</td>
                <td>عنوان</td>
                <td>نویسنده</td>
                <td>توضیحات</td>
                <td>دسته بندی</td>
                <td>وضعیت</td>
                <td>تاریخ ایجاد</td>
            </thead>
        </table>
        <div>
            {{$posts->links()}}
        </div>
    </div>
@endsection
