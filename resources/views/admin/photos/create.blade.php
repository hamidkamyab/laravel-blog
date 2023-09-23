@extends('admin.layouts.master')


@section('styles')
    <link href="{{asset('css/dropzone.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <h4 class="my-1 bg-white p-2 w-auto d-inline-block">آپلود عکس</h4>
    <div class="bg-white p-4">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div><span>{{ $error }}</span></div>
                @endforeach
            </div>
        @endif

        <form action="{{route('photos.store')}}" method="POST" class="dropzone" id="my-awesome-dropzone"> @csrf </form>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection
