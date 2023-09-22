@extends('admin.layouts.master')

@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">لیست دسته بندی ها</h4>
    <div class="bg-white p-4">
        @if (Session::has('delete_photo'))
            <div class="alert alert-success">
                <div>
                    {{Session('delete_photo')}}
                </div>
            </div>
        @endif
        @if (Session::has('add_photo'))
            <div class="alert alert-success">
                <div>
                    {{Session('add_photo')}}
                </div>
            </div>
        @endif
        @if (Session::has('edit_photo'))
            <div class="alert alert-success">
                <div>
                    {{Session('edit_photo')}}
                </div>
            </div>
        @endif
        <table class="table table-hover">
            <thead>
                <td>#</td>
                <td>تصویر</td>
                <td>نام تصویر</td>
                <td>کاربر</td>
                <td>تاریخ ایجاد</td>
            </thead>
            <tbody>
                @foreach ($photos as $key => $photo)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><img src="{{ asset($photo->path) }}" width="62px" height="62px" /></td>
                        <td>{{ $photo->name }}</td>
                        <td>{{ $photo->user->name }}</td>
                        <td>{{ verta($photo->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
                <td>#</td>
                <td>تصویر</td>
                <td>نام تصویر</td>
                <td>کاربر</td>
                <td>تاریخ ایجاد</td>
            </thead>
        </table>
    </div>
@endsection
