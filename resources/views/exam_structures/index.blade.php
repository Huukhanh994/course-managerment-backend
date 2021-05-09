@extends('layouts.app')

@section('title')
Cơ cấu đề thi
@endsection
@section('body.content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Thêm
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('exam_structures.storeExamStructure')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm cơ cấu đề thi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Tên cấu trúc đề thi</span>
                    <input type="text" name="exam_structure_name" class="form-control">
                </div>
                <div class="modal-body">
                    <span>Số lượng câu hỏi</span>
                    <input type="text" name="exam_structure_quantity" class="form-control">
                </div>
                <div class="modal-body">
                    <span>Số lượng câu hỏi dễ</span>
                    <input type="text" name="exam_structure_ez" class="form-control">
                </div>
                <div class="modal-body">
                    <span>Số lượng câu hỏi trung bình</span>
                    <input type="text" name="exam_structure_me" class="form-control">
                </div>
                <div class="modal-body">
                    <span>Số lượng câu hỏi khó</span>
                    <input type="text" name="exam_structure_ha" class="form-control">
                </div>
                <div class="modal-body">
                    <span>Thuộc môn</span>
                    <select class="form-control select-subject" name="subject_id">
                        <option value="">--Chọn Môn--</option>
                        @foreach ($data as $item)
                        <option value="{{$item['subject_id']}}">{{ $item['subject_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-body">
                    <span>Thuộc chương</span>
                    <select class="form-control select-chapter" name="chapter_id">
                        <option value="">--Chọn Chương--</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>


<table class="table table-hover" id="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Thuộc chương</th>
            <th scope="col">Số lượng tối đa</th>
            <th scope="col">Số câu dễ</th>
            <th scope="col">Số câu trung bình</th>
            <th scope="col">Số câu khó</th>
            <th scope="col">Tuỳ chọn</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($examStructures as $item)
        <tr>
            <th scope="row">{{$item['exam_structure_id']}}</th>
            <td>{{$item->chapter->chapter_name}}</td>
            <td>{{$item['exam_structure_quantity']}}</td>
            <td>{{$item['exam_structure_ez']}}</td>
            <td>{{$item['exam_structure_me']}}</td>
            <td>{{$item['exam_structure_ha']}}</td>
            <td>
                <a href="#" class="select-action-pratice-test" data-toggle="modal"
                    data-target=".modal-lg-edit{{$item['exam_structure_id']}}">
                    <i class="fas fa-edit"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="color:red;" class="remove" idAction=2 data-practest-id="">
                    <i class="far fa-trash-alt"></i>
                </a>
            </td>
            @include('exam_structures.modal.form_edit',['examStructures' => $examStructures,'data' => $data])
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
            "order": [[ 0, "asc" ]],
            "bPaginate": false,
        });

        $(".select-subject").change(function (e) { 
          e.preventDefault();
          let id= $(this).val();
          $.ajax({
            type: "GET",
            url: "chapters/"+id+"/get-chapter",
            success: function (response) {
                console.log(response);
              let option=""
              $.each(response, function (indexInArray, valueOfElement) { 
                console.log(valueOfElement);
                option+="<option value="+valueOfElement.chapter_id+">"+valueOfElement.chapter_name+"</option>"
              });
              $(".select-chapter").html(option);
                }
              });
        });
} );
</script>
@endpush