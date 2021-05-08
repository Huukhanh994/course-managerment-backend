@extends('layouts.app')

@section('title')
Câu hỏi
@endsection
@section('body.content')

<form action="" method="post">
    @csrf

    <div class="row">
        <div class="col-md-2">Câu hỏi</div>
        <div class="col-md-10"><input type="text" required></div>
        <div class="col-md-2">Câu Đáp án A</div>
        <div class="col-md-10"><input type="text" required></div>
        <div class="col-md-2">Câu Đáp án B</div>
        <div class="col-md-10"><input type="text" required></div>
        <div class="col-md-2">Câu Đáp án C</div>
        <div class="col-md-10"><input type="text" required></div>
        <div class="col-md-2">Câu Đáp án D</div>
        <div class="col-md-10"><input type="text" required></div>
        <div class="col-md-2">Đáp án đúng</div>
        <div class="col-md-10"><input type="text" required></div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success">Lưu</button>
            <button type="button" class="btn btn-info" onclick="window.history.back();>Trở lại</button>
        </div>
    </div>
</form>


@endsection
@push('body.scripts')
<script>

</script>
@endpush