@extends('admin.layouts.master')


@section('content')
    <div class="bg-white p-4">
        <div class="row">

            <div class="col-8 p-2" style="background-color: rgb(221, 221, 221)">
                <div class="d-flex p-1 justify-content-between align-items-center" style="direction: rtl; background-color: rgb(191, 191, 191)">
                    <div class="d-flex align-items-center" style="gap:15px;">
                        <div class="d-flex align-items-center" style="gap:6px">
                            <i class="icon-pencil"></i>
                            <span>نام:</span>
                            <span>{{ $comment->name }}</span>
                        </div>
                        |
                        <div class="d-flex align-items-center" style="gap:6px">
                            <i class="icon-envelope-letter"></i>
                            <span>ایمیل:</span>
                            <span>{{ $comment->email }}</span>
                        </div>
                        |
                        <div class="d-flex align-items-center" style="gap:6px">
                            <i class="icon-calendar"></i>
                            <span>تاریخ:</span>
                            <span>
                                {{ verta($comment->created_at)->format('H:m:s') }} - {{ verta($comment->created_at)->format('Y/m/d') }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <a href="{{route('comments.index')}}" class="d-flex align-items-center" style="text-decoration: none">
                            <i class="fa fa-long-arrow-left" style="color:#444; font-size: 24px"></i>
                        </a>
                    </div>
                </div>
                <div class="p-1" style="direction: rtl; background-color: rgb(191, 191, 191); margin-top: 5px">
                    <p>
                        {{$comment->body}}
                    </p>
                </div>

                <div class="p-1" style="direction: rtl; background-color: rgb(191, 191, 191); margin-top: 5px">
                    <form action="{{route('comments.replay',$comment->id)}}" method="POST">
                        @csrf
                        {{-- <input type="hidden" name="parent_id" value="{{$comment->id}}" />
                        <input type="hidden" name="post_id" value="{{$comment->post->id}}" /> --}}
                        <textarea name="body" id="textAreaReplay" rows="10" class="form-control" style="background-color: #eee"></textarea>
                        <button type="submit" class="btn btn-primary" style="font-size: 12px;">پاسخ به نظر</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
