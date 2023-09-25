@extends('admin.layouts.master')


@section('content')
    <div class="bg-white p-4">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-primary">
                    <div class="card-block p-b-0">
                        <div class="p-a-0 pull-left">
                            <i class="icon-picture" style="font-size: 18px"></i>
                        </div>
                        <h4 class="m-b-0">{{ $photosCount }}</h4>
                        <p>رسانه</p>
                    </div>
                    <div class="chart-wrapper p-x-1" style="height:70px;">
                        <canvas id="card-chart1" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-info">
                    <div class="card-block p-b-0">
                        <div class="p-a-0 pull-left">
                            <i class="icon-layers" style="font-size: 18px"></i>
                        </div>
                        <h4 class="m-b-0">{{ $categoriesCount }}</h4>
                        <p>دسته بندی ها</p>
                    </div>
                    <div class="chart-wrapper p-x-1" style="height:70px;">
                        <canvas id="card-chart2" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-warning">
                    <div class="card-block p-b-0">
                        <div class="p-a-0 pull-left">
                            <i class="icon-docs" style="font-size: 18px"></i>
                        </div>
                        <h4 class="m-b-0">{{ $postsCount }}</h4>
                        <p>مطالب</p>
                    </div>
                    <div class="chart-wrapper" style="height:70px;">
                        <canvas id="card-chart3" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card card-inverse card-danger">
                    <div class="card-block p-b-0">
                        <div class="p-a-0 pull-left">
                            <i class="icon-people" style="font-size: 18px"></i>
                        </div>
                        <h4 class="m-b-0">{{ $usersCount }}</h4>
                        <p>کاربران</p>
                    </div>
                    <div class="chart-wrapper p-x-1" style="height:70px;">
                        <canvas id="card-chart4" class="chart" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!--/col-->


            <div class="row">
                <div class="col-6 p-2">
                    <h6>جدیدترین مطالب</h6>
                    <table class="table table-hover fs-5">
                        <thead>
                            <td>عنوان</td>
                            <td>نویسنده</td>
                            <td>وضعیت</td>
                            <td>تاریخ ایجاد</td>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{  Str::limit($post->title,15,'...') }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        @if ($post->status == 0)
                                            <span class="badge bg-danger">
                                                منتشر نشده
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                منتشر شده
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ verta($post->created_at)->formatDifference() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-6 p-2">
                    <h6>جدیدترین کاربران</h6>
                    <table class="table table-hover fs-5">
                        <thead>
                            <td>نام</td>
                            <td>ایمیل</td>
                            <td>وضعیت</td>
                            <td>تاریخ ایجاد</td>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
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
                                    <td>{{ verta($user->created_at)->formatDifference() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>







        </div>
    </div>
@endsection
