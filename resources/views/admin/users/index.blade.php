@extends('admin.layouts.master')

@section('content')
<div>
    <div class="bg-white p-2">
        <table class="table table-hover">
            <thead>
                <td>#</td>
                <td>نام</td>
                <td>ایمیل</td>
                <td>نقش</td>
                <td>تاریخ</td>
            </thead>
            <tbody>
                @foreach ($users as $key=>$user)
                    <tr>
                        <td>{{$key+1}}</td>

                        <td>{{$user->name}}</td>

                        <td>{{$user->email}}</td>

                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-success">
                                    {{$role->title}}
                                </span>
                            @endforeach
                        </td>

                        <td>{{verta($user->created_at)}}</td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
                <td>#</td>
                <td>نام</td>
                <td>ایمیل</td>
                <td>نقش</td>
                <td>تاریخ</td>
            </thead>
        </table>
    </div>
</div>
@endsection
