@foreach ($comments as $comment)
@if ($comment->status == 1)
<div class="d-flex flex-1 flex-column bg-dark-800 p-2 mb-2">

    <div class="d-flex flex-column w-100" style="gap: 8px">
        <div class="d-flex justify-content-between align-items-center"
            style="font-size: 14px;font-weight: 600">
            <div class="d-flex align-items-center" style="gap: 8px">
                <i class="fa fa-pen" style="font-size: 12px;"></i>
                <span>{{ $comment->name }}</span>
            </div>
            <div class="d-flex align-items-center" style="gap: 8px">
                <i class="fa fa-calendar-alt" style="font-size: 12px;"></i>
                <span>
                    {{ verta($comment->created_at)->format('H:i:s') }}
                    -
                    {{ verta($comment->created_at)->format('Y/m/d') }}
                </span>
            </div>
        </div>
        <p class="p-2" style="background-color: rgb(60, 60, 65);font-size: 16px; border-radius: 6px">
            {{ $comment->body }}
        </p>
        <div class="d-flex justify-content-end">
            <a id="comment-form-{{ $comment->id }}" class="btn-sm btn-dark btn-open"
                style="font-weight: 600" role="button">پـاسـخ</a>
        </div>

        <div class="col-12 formDiv" id="f-comment-form-{{ $comment->id }}" style="display: none">
        <form action="{{ route('comment.reply', [$post->id, $comment->id]) }}" method="Post">
            @csrf
            @guest
                <div class="form-group">
                    <label for="nameInput" style="font-size:14px;font-weight: 600">نام:</label>
                    <input type="text" class="form-control form-control-sm" id="nameInput"
                        name="name" value="{{ old('name') }}"
                        style="background-color: rgb(60, 60, 65);" />
                </div>
                <div class="form-group">
                    <label for="emailInput" style="font-size:14px;font-weight: 700">ایمیل:</label>
                    <input type="email" class="form-control" id="emailInput" name="email"
                        value="{{ old('email') }}" style="background-color: rgb(60, 60, 65);" />
                </div>
            @endguest

            <div class="form-group">
                <label for="bodyInput" style="font-size:14px;font-weight: 700">متن پاسخ</label>
                <textarea class="form-control h-auto" id="bodyInput" name="body" rows="5"
                    style="background-color: rgb(60, 60, 65);">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-sm btn-outline-red"
                    style="letter-spacing: 0em;font-weight: bold" type="submit">ثـبـت پـاسـخ</button>
                <a class="btn btn-sm btn-outline-info" role="button"
                    style="letter-spacing: 0em;font-weight: bold"
                    onclick="$('.formDiv').fadeOut(0)">لـغـو</a>
            </div>
        </form>
    </div>
    </div>

    @include('frontend.partials.comment',['comments' => $comment->replies])

</div>
@endif
@endforeach

<script>
    $('.btn-open').click(function() {
        $('.formDiv').fadeOut(0);
        setTimeout(() => {
            const id = this.id;
            const formId = '#f-' + id;
            $(formId).show('slow')
        }, 100);
    });
</script>
