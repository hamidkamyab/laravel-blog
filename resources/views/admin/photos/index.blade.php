@extends('admin.layouts.master')


@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">لیست تصاویر</h4>
    <div class="bg-white p-4">
        @if (Session::has('delete_photo'))
            <div class="alert alert-success">
                <div>
                    {{Session('delete_photo')}}
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
                <td>حذف</td>
            </thead>
            <tbody>
                @foreach ($photos as $key => $photo)
                    <tr>
                        <td>{{ (($photos->currentPage()-1) * 5) + ($key + 1) }}</td>
                        <td><img src="{{ asset($photo->path) }}" width="62px" height="62px" /></td>
                        <td>{{ $photo->name }}</td>
                        <td>{{ $photo->user->name }}</td>
                        <td>{{ verta($photo->created_at)->formatDifference() }}</td>
                        <td>
                            <form method="POST" action="{{route('photos.destroy',$photo->id)}}" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: transparent;border:none;">
                                    <i class="icon-close" style="color:red;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
                <td>#</td>
                <td>تصویر</td>
                <td>نام تصویر</td>
                <td>کاربر</td>
                <td>تاریخ ایجاد</td>
                <td>حذف</td>
            </thead>
        </table>
        <div>
            {{$photos->links()}}
        </div>
    </div>
@endsection

