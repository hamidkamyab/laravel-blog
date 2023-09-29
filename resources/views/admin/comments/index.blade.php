@extends('admin.layouts.master')

@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">لیست نظرات</h4>
    <div class="bg-white p-4">
        @if (Session::has('delete_comment'))
            <div class="alert alert-success">
                <div>
                    {{Session('delete_comment')}}
                </div>
            </div>
        @endif
        @if (Session::has('replay_comment'))
            <div class="alert alert-success">
                <div>
                    {{Session('replay_comment')}}
                </div>
            </div>
        @endif
        @if (Session::has('action_comment'))
            <div class="alert alert-success">
                <div>
                    {{Session('action_comment')}}
                </div>
            </div>
        @endif
        <table class="table table-hover" style="font-size: 14px">
            <thead>
                <td>#</td>
                <td>متن دیدگاه</td>
                <td>نام نویسنده</td>
                <td>مطلب</td>
                <td>تاریخ ایجاد</td>
                <td>وضعیت</td>
                <td>عملیات</td>
                <td>مشاهده</td>
                <td>حذف</td>
            </thead>
            <tbody>
                @foreach ($comments as $key => $comment)
                    <tr>
                        <td>{{ (($comments->currentPage()-1) * 5) + ($key + 1) }}</td>
                        <td>
                            {{ Str::limit($comment->body, 20, '...') }}
                        </td>

                        <td>
                            {{ Str::limit($comment->name, 20, '...') }}
                        </td>

                        <td>
                            {{ Str::limit($comment->post->title, 20, '...') }}
                        </td>
                        <td>
                            {{ verta($comment->created_at)->formatDifference() }}
                        </td>
                        <td>
                            @if ($comment->status == 0)
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
                            <form action="{{route('comments.action',$comment->id)}}" method="Post" style="padding:0;margin: 0">
                                @csrf
                                @method('Patch')
                                    @if($comment->status == 0)
                                        <input type="hidden" name="action" value="1" />
                                        <button class="btn btn-primary btn-sm" style="font-size: 12px">انتشار</button>
                                    @else
                                        <input type="hidden" name="action" value="0" />
                                        <button class="btn btn-danger btn-sm"  style="font-size: 12px">عدم انتشار</button>
                                    @endif
                            </form>
                        </td>
                        <td>
                            <a href="{{route('comments.show',$comment->id)}}">
                                <i class="icon-eye"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{route('comments.destroy',$comment->id)}}" method="POST" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button href="{{route('comments.destroy',$comment->id)}}" class="text-danger" style=" background: transparent; border:none;">
                                    <i class="fa fa-close" style="font-size: 18px"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
            <thead>
                <td>#</td>
                <td>متن دیدگاه</td>
                <td>نام نویسنده</td>
                <td>مطلب</td>
                <td>تاریخ ایجاد</td>
                <td>وضعیت</td>
                <td>عملیات</td>
                <td>مشاهده</td>
                <td>حذف</td>
            </thead>
        </table>
        <div>
            {{$comments->links()}}
        </div>
    </div>
@endsection
