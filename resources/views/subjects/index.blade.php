@extends('layouts.app')

@section('title')
Môn học
@endsection
@section('body.content')
<!-- Button subject modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalSubject">
    Thêm môn
</button>
<!-- Button chapter modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalChapter">
    Thêm Chương
</button>
<!-- Modal Subject-->
<div class="modal fade" id="ModalSubject" tabindex="-1" role="dialog" aria-labelledby="ModalSubject" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('subjects.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalSubject">Thêm môn học</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Môn học</span>
                    <input type="text" class="form-control" name="subject_name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Topic-->
<div class="modal fade" id="ModalChapter" tabindex="-1" role="dialog" aria-labelledby="ModalChapter" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('chapters.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalChapter">Thêm môn học</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Tên môn học</span>
                    <select name="subject_id" id="" class="form-control" required>
                        <option value="">--Chọn Môn Học--</option>
                        @foreach ($subjects as $key=>$subject)
                        <option value="{{$subject->subject_id}}">{{$subject->subject_name}}</option>
                        @endforeach
                    </select>
                    <span>Tên chương</span>
                    <input type="text" class="form-control" name="chapter_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<table class="table table-hover" id="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên môn</th>
            <th scope="col">Chương</th>
            <th scope="col">Tuỳ chọn</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects as $key=>$subject)

        <tr>
            <th scope="row">{{$key+1}}</th>
            <td colspan=>{{$subject->subject_name}}</td>
            <td colspan=>
                @foreach ($subject->chapters as $chapter)
                {{$chapter->chapter_name}}<br>
                @endforeach
            </td>
            <td>
                <form action="{{route('subjects.delete',$subject->subject_id)}}" method="POST">
                    @csrf
                    <a href="" class="select-action-pratice-test" target="_blank" data-practest-id="" idAction=1>
                        <i class="fas fa-edit"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    <button style="color:red;" class="remove bg-transparent border-0" type="submit">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection
@push('body.scripts')
<script>
    $(document).ready( function () {
        $('#table').DataTable({
            
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Vietnamese.json"
            },
            "order": [[ 0, "asc" ]]
        });
} );
</script>
@endpush