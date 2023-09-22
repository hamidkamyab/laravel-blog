@extends('admin.layouts.master')
@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">ایجاد دسته بندی جدید</h4>
    <div class="bg-white p-4">
        @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div><span>{{$error}}</span></div>
                    @endforeach
                </div>
        @endif
        <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="titleInput">عنوان دسته بندی:</label>
                <input type="text" name="title" id="titleInput" class="form-control" />
            </div>
            <div class="form-group">
                <label for="slugInput">نام مستعار دسته بندی:</label>
                <small class="text-danger">(درصورت عدم ورود نام مستعار، عنوان دسته بندی برای نام مستعار نیز قرار میگیرد!)</small>
                <input type="text" name="slug" id="slugInput" class="form-control" />
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
                <button type="submit" class="btn btn-primary">ثبت دسته بندی</button>
            </div>
        </form>

    </div>
@endsection
