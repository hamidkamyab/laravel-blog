@extends('admin.layouts.master')

@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">لیست دسته بندی ها</h4>
    <div class="bg-white p-4">
        @if (Session::has('delete_category'))
            <div class="alert alert-success">
                <div>
                    {{Session('delete_category')}}
                </div>
            </div>
        @endif
        @if (Session::has('add_category'))
            <div class="alert alert-success">
                <div>
                    {{Session('add_category')}}
                </div>
            </div>
        @endif
        @if (Session::has('edit_category'))
            <div class="alert alert-success">
                <div>
                    {{Session('edit_category')}}
                </div>
            </div>
        @endif
        <table class="table table-hover"  style="font-size: 14px">
            <thead>
                <td>#</td>
                <td>عنوان</td>
                <td>تاریخ ایجاد</td>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ (($categories->currentPage()-1) * 5) + ($key + 1) }}</td>
                        <td><a href="{{ route('categories.edit', $category->id) }}">{{ $category->title }}</a></td>
                        <td>{{ verta($category->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
                <td>#</td>
                <td>عنوان</td>
                <td>تاریخ ایجاد</td>
            </thead>
        </table>
        <div>
            {{$categories->links()}}
        </div>
    </div>
@endsection
