@extends('admin.layouts.master')

@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">لیست کاربران</h4>
    <div class="bg-white p-4">
        @if (Session::has('delete_user'))
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
        @endif
        <table class="table table-hover">
            <thead>
                <td>#</td>
                <td>تصویر کاربر</td>
                <td>نام</td>
                <td>ایمیل</td>
                <td>نقش</td>
                <td>وضعیت</td>
                <td>تاریخ</td>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>

                        <td>
                            @if ($user->photo_id)
                                <img src={{ asset($user->photo['path']) }} width="48px" height="48px"
                                    style="border-radius:50%" />
                            @else
                                <img src="{{ asset('img/default.jpg') }}" width="48px" height="48px"
                                    style="border-radius:50%">
                            @endif
                        </td>

                        <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></td>

                        <td>{{ $user->email }}</td>

                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-success">
                                    {{ $role->title }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @if ($user->status == 0)
                                <span class="badge bg-danger">
                                    غیرفعال
                                </span>
                            @else
                                <span class="badge bg-success">
                                    فعال
                                </span>
                            @endif
                        </td>
                        <td>{{ verta($user->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
                <td>#</td>
                <td>تصویر کاربر</td>
                <td>نام</td>
                <td>ایمیل</td>
                <td>نقش</td>
                <td>وضعیت</td>
                <td>تاریخ</td>
            </thead>
        </table>
    </div>
@endsection
