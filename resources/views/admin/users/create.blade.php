@extends('admin.layouts.master')
@section('content')

    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">ایجاد کاربر جدید</h4>
    <div class="bg-white p-4">

        <form>
            <div class="form-group">
                <label for="nameInput">نام کاربر:</label>
                <input type="text" name="name" id="nameInput" class="form-control" />
            </div>
            <div class="form-group">
                <label for="emailInput">ایمیل کاربر:</label>
                <input type="text" name="email" id="emailInput" class="form-control" />
            </div>
            <div class="form-group">
                <label for="passInput">رمز عبور کاربر:</label>
                <input type="text" name="password" id="passInput" class="form-control" />
            </div>
            <div class="form-group">
                <label for="roleSelect">نقش کاربر:</label>
                <small>(برای انتخاب چند نقش کلید shift را نگه دارید و سپس نقش ها را انتخاب کنید.)</small>
                <select id="roleSelect" multiple="multiple" name="role[]" class="form-control">
                    @foreach ($roles as $key=>$role)
                        <option value="{{$key}}" @if($key == 1) selected="selected" @endif >{{$role}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="statusSelect">وضعیت کاربر:</label>
                <select id="statusSelect" class="form-control" name="status">
                    <option value="0" selected="selected">غیرفعال</option>
                    <option value="1">فعال</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">ثبت کاربر</button>
            </div>
        </form>

    </div>

@endsection
