@extends('admin.layouts.master')
@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">ایجاد کاربر جدید</h4>
    <div class="bg-white p-4">
        @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div><span>{{$error}}</span></div>
                    @endforeach
                </div>
        @endif
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="titleInput">عنوان:</label>
                <input type="text" name="title" id="titleInput" class="form-control" />
            </div>
            <div class="form-group">
                <label for="slugInput">لینک(نام مستعار):</label>
                <small class="text-danger">(درصورت عدم ورود نام مستعار، عنوان مطلب برای نام مستعار نیز قرار میگیرد!)</small>
                <input type="text" name="slug" id="slugInput" class="form-control" />
            </div>
            <div class="form-group">
                <label for="bodyInput">متن:</label>
                <textarea name="body" id="bodyInput" class="form-control" ></textarea>
            </div>
            <div class="form-group my-2">
                <label for="photoInput">تصویر مطلب</label>
                <input id="photoInput" class="form-control form-control-file" type="file" name="photo">
            </div>

            <div class="form-group">
                <label for="metaDescriptionInput">متا توضیحات:</label>
                <textarea name="meta_description" id="metaDescriptionInput" class="form-control" ></textarea>
            </div>
            <div class="form-group">
                <label for="metaKeywordsInput">کلمات کلیدی:</label>
                <textarea name="meta_keywords" id="metaKeywordsInput" class="form-control" ></textarea>
            </div>

            <div class="form-group">
                <label for="roleSelect">دسته بندی:</label>
                <small>(برای انتخاب چند نقش کلید shift یا ctrl را نگه دارید و سپس نقش ها را انتخاب کنید.)</small>
                <select id="categorySelect" multiple="multiple" name="categories[]" class="form-control">
                    @foreach ($categories as $key => $category)
                        <option value="{{ $key }}" @if ($key == 1) selected="selected" @endif>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="statusSelect">وضعیت مطلب:</label>
                <select id="statusSelect" class="form-control" name="status">
                    <option value="0" selected="selected">منتشر نشده</option>
                    <option value="1">منتشر شده</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">ثبت مطلب</button>
            </div>
        </form>

    </div>
@endsection
