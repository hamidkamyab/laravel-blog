@extends('admin.layouts.master')

@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">لیست پست ها</h4>
    <div class="bg-white p-4">
        {{-- @if (Session::has('delete_user'))
            <div class="alert alert-success">
                <div>
                    {{Session('delete_user')}}
                </div>
            </div>
        @endif
        @if (Session::has('add_user'))
            <div class="alert alert-success">
                <div>
                    {{Session('add_user')}}
                </div>
            </div>
        @endif
        @if (Session::has('edit_user'))
            <div class="alert alert-success">
                <div>
                    {{Session('edit_user')}}
                </div>
            </div>
        @endif --}}
        <table class="table table-hover">
            <thead>
                <td>#</td>
                <td>عنوان</td>
                <td>نویسنده</td>
                <td>توضیحات</td>
                <td>دسته بندی</td>
                <td>تاریخ ایجاد</td>
                <td>تاریخ ویرایش</td>
            </thead>
            <tbody>
                @foreach ($posts as $key => $post)
                    <tr>
                        <td>{{ $key + 1 }}</td>

                        <td>
                           {{$post->title}}
                        </td>

                        <td>
                            {{$post->user->name}}
                        </td>

                        <td>{{ $post->meta_description }}</td>

                        <td>
                            @foreach ($post->categories as $category)
                                <span class="badge bg-success">
                                    {{ $category->title }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            {{ verta($post->created_at) }}
                        </td>
                        <td>
                            {{ verta($post->update_at) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
                <td>#</td>
                <td>عنوان</td>
                <td>نویسنده</td>
                <td>توضیحات</td>
                <td>دسته بندی</td>
                <td>تاریخ ایجاد</td>
                <td>تاریخ ویرایش</td>
            </thead>
        </table>
    </div>
@endsection
