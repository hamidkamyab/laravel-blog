@extends('admin.layouts.master')
@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">ویرایش پست</h4>
    <div class="bg-white p-4">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div><span>{{ $error }}</span></div>
                @endforeach
            </div>
        @endif
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="titleInput">عنوان:</label>
                <input type="text" name="title" id="titleInput" class="form-control" value="{{ $post->title }}" />
            </div>
            <div class="form-group">
                <label for="slugInput">لینک(نام مستعار):</label>
                <small class="text-danger">(درصورت عدم ورود، عنوان مطلب برای نام مستعار نیز قرار میگیرد!)</small>
                <input type="text" name="slug" id="slugInput" class="form-control" value="{{ $post->slug }}" />
            </div>
            <div class="form-group">
                <label for="bodyInput">متن:</label>
                <textarea name="body" id="bodyInput" class="form-control">{{ $post->body }}</textarea>
            </div>
            <div class="form-group my-2">
                <div class="d-flex align-items-center" >
                    <div class="flex-grow-3">
                        <label for="photoInput">تصویر مطلب</label>
                        <input id="photoInput" class="form-control form-control-file" type="file" name="photo">
                    </div>
                    <div class="flex-grow-1">
                        @if (@$post->photos[0])
                            <img src="{{asset($post->photos[0]->path)}}" width="148px" height="148px" style="float: left; border-radius:10px" />
                        @else
                            <img src="{{ asset('img/default.jpg') }}" width="148px" height="148px" style="float: left; border-radius:10px" />
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="metaDescriptionInput">متا توضیحات:</label>
                <textarea name="meta_description" id="metaDescriptionInput" class="form-control">{{ $post->meta_description }}</textarea>
            </div>
            <div class="form-group">
                <label for="metaKeywordsInput">کلمات کلیدی:</label>
                <input name="meta_keywords" id="metaKeywordsInput" class="form-control"
                    value="{{ $post->meta_keywords }}" />
            </div>

            <div class="form-group">
                <label for="roleSelect">دسته بندی:</label>
                <small>(برای انتخاب چند نقش کلید shift یا ctrl را نگه دارید و سپس نقش ها را انتخاب کنید.)</small>
                <select id="categorySelect" multiple="multiple" name="categories[]" class="form-control">
                    @foreach ($categories as $key => $category)
                        <option value="{{ $key }}" @if (@$category['selected'] == 1) selected="selected" @endif>
                            {{ $category['title'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">

                <label for="statusSelect">وضعیت مطلب:</label>
                <select id="statusSelect" class="form-control" name="status">
                    <option value="0" @if ($post->status == 0) selected="selected" @endif>
                        منتشر نشده
                    </option>
                    <option value="1" @if ($post->status == 1) selected="selected" @endif>منتشر شده
                    </option>
                </select>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">ویرایش کاربر</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-success">بازگشت</a>
            </div>
        </form>
        <form action="{{ route('posts.destroy', $post->id) }}" method="Post">
            @csrf
            @method('DELETE')
            <div class="form-group" style="height: 10px;">
                <button type="submit" class="btn btn-outline-danger pull-left">حذف کاربر</button>
            </div>
        </form>

    </div>
@endsection
