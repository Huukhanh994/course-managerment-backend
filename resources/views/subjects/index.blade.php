@extends('layouts.app')

@section('title')
Môn học
@endsection
@push('body.head')
    <style>
        .hide{
            display: none;
        }
    </style>
@endpush
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
                    <h5 class="modal-title" id="ModalChapter">Thêm chương</h5>
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
                    <input type="text" class="form-control" name="chapter_name" required>
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
            <th scope="col">Tuỳ chọn môn</th>
            <th scope="col">Chương</th>
            <th scope="col">Tuỳ chọn chương</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects as $key=>$subject)

        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>
                <span class="{{$subject->subject_id}}">
                    {{$subject->subject_name}}
                </span>
                <div class="edit{{$subject->subject_id}} hide">
                    <input type="text" value="{{$subject->subject_name}}" subject-id="{{$subject->subject_id}}" class="inp-subject">
                </div>
            </td>
            <td>
                <form action="{{route('subjects.delete',$subject->subject_id)}}" method="POST">
                    @csrf

                    <a href="" class="edit-subject" subject-id="{{$subject->subject_id}}"
                        data-toogle="tooltip" title="Chỉnh sửa môn">
                        <i class="fas fa-edit"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;


                    <button style="color:red;" class="remove bg-transparent border-0" type="submit">
                        <i class="far fa-trash-alt"></i>
                    </button>
            </td>
            <td>
                @foreach ($subject->chapters as $chapter)
                <span class="{{$chapter->chapter_id}}">
                    {{$chapter->chapter_name}}<br>
                </span>
                <div class="edit{{$chapter->chapter_id}} hide">
                    <input type="text" value="{{$chapter->chapter_name}}" chapter-id="{{$chapter->chapter_id}}" class="inp-chapter">
                </div>
                @endforeach
            </td>
            <td>
                @foreach ($subject->chapters as $chapter)
                <form action="{{route('chapters.delete',$chapter->chapter_id)}}" method="POST">
                    @csrf

                    <a href="" class="edit-chapter" chapter-id="{{$chapter->chapter_id}}"
                        data-toogle="tooltip" title="Chỉnh sửa chương">
                        <i class="fas fa-edit"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;


                    <button style="color:red;" class="remove bg-transparent border-0" type="submit">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
                @endforeach
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection
@push('body.scripts')
<script>
    $(document).ready( function () {

        // subject
        $('.edit-subject').click(function (e) { 
            e.preventDefault();
            let id=$(this).attr('subject-id');
            $("."+id).addClass('hide');
            $('.edit'+id).removeClass('hide');
        });
        $('.edit-chapter').click(function (e) { 
            e.preventDefault();
            let id=$(this).attr('subject-id');
            $("."+id).addClass('hide');
            $('.edit'+id).removeClass('hide');
            
        });
        $('.inp-subject').bind("enterKey",function(e){
            e.preventDefault();
            let id=$(this).attr('subject-id');
            let value=$(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "{{route('subjects.update')}}",
                data: {id:id,value:value},
                success: function (response) {
                    location.reload();
                },
                error: function (e) {
                    console.log(e);
                }
            });
            
        });
        $(".inp-subject").focus(function() {
        }).blur(function() {
            $(this).trigger("enterKey");
        });
        $('.inp-subject').keyup(function(e){
            if(e.keyCode == 13||e.keyCode==9)
            {
                $(this).trigger("enterKey");
            }
        });

        // chapter
        $('.edit-chapter').click(function (e) { 
            e.preventDefault();
            let id=$(this).attr('chapter-id');
            $("."+id).addClass('hide');
            $('.edit'+id).removeClass('hide');
        });
        $('.edit-chapter').click(function (e) { 
            e.preventDefault();
            let id=$(this).attr('chapter-id');
            $("."+id).addClass('hide');
            $('.edit'+id).removeClass('hide');
            
        });
        $('.inp-chapter').bind("enterKey",function(e){
            e.preventDefault();
            let id=$(this).attr('chapter-id');
            let value=$(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "{{route('chapters.update')}}",
                data: {id:id,value:value},
                success: function (response) {
                    location.reload();
                },
                error: function (e) {
                    console.log(e);
                }
            });
            
        });
        $(".inp-chapter").focus(function() {
        }).blur(function() {
            $(this).trigger("enterKey");
        });
        $('.inp-chapter').keyup(function(e){
            if(e.keyCode == 13||e.keyCode==9)
            {
                $(this).trigger("enterKey");
            }
        });

        $('#table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Vietnamese.json"
            },
            "order": [[ 0, "asc" ]]
        });


} );
</script>
@endpush