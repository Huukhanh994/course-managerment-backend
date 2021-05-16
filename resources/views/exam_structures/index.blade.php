@extends('layouts.app')

@section('title')
Cơ cấu đề thi
@endsection
@section('body.content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-xl">
    Thêm
</button>

<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm cơ cấu đề thi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('exam_structures.storeExamStructure')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content div-examStructute">
                        <div class=>
                            <input type="text" name="exam_structure_name" class="form-control" placeholder="Nhập tên cơ cấu đề thi">
                        </div>
                            <div class="row exam_structure-div" id="item_1">
                                <div class="col-2">
                                    <select class="" name="chapter_id[]">
                                        @foreach ($result as $item)
                                        <optgroup label="{{$item['subject_name']}}">
                                            @foreach ($item['chapters'] as $row)
                                                <option value="{{$row['chapter_id']}}">{{$row['chapter_name']}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="text" name="exam_structure_quantity[]" class="form-control" placeholder="Nhập tổng số câu hỏi của cơ cấu đề thi">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="exam_structure_ez[]" class="form-control" placeholder="Nhập số câu dễ">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="exam_structure_me[]" class="form-control" placeholder="Nhập số câu trung bình">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="exam_structure_ha[]" class="form-control" placeholder="Nhập số câu khó">
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-warning" id="add-item">+ Thêm chương</button>
                                <button type="button" class="btn btn-danger" id="delete">- Xoá</button>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                <a href="#" style="color:red;" class="remove" data-id="{{$item['exam_structure_id']}}" idAction=2 data-practest-id="">
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
              let option=""
              $.each(response, function (indexInArray, valueOfElement) { 
                option+="<option value="+valueOfElement.chapter_id+">"+valueOfElement.chapter_name+"</option>"
              });
              $(".select-chapter").html(option);
                }
              });
        });


        $(".remove").click(function() {
        var examStructureId = $(this).data('id');
        Swal.fire({
        title: "Delete?",
        text: "Please ensure and then confirm!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
        }).then(function (e) {
        
        if (e.value === true) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
        type: 'GET',
        url: "exam-structures/delete/"+examStructureId,
        data: {_token: CSRF_TOKEN},
        dataType: 'JSON',
        success: function (response) {
        
        if (response.success) {
        Swal.fire('Saved!', response.success, 'success')
        }
        location.reload();
        }
        });
        
        } else {
        e.dismiss;
        }
        
        }, function (dismiss) {
        return false;
        })
        })

    $("#add-item").click(function() {
        var totalElement = $('.exam_structure-div').length;
        var max = 10;
        var lastId = $(".exam_structure-div:last").attr("id");
        var splitId = lastId.split("_");
        var nextItem = Number(splitId[1] + 1);

        if(totalElement < max) {
            let listExamStructure = `
            <div class="row exam_structure-div" id="item_${nextItem}">
                <div class="col-2">
                    <select class="" name="chapter_id[]">
                        @foreach ($result as $item)
                        <optgroup label="{{$item['subject_name']}}">
                            @foreach ($item['chapters'] as $row)
                            <option value="{{$row['chapter_id']}}">{{$row['chapter_name']}}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <input type="text" name="exam_structure_quantity[]" class="form-control"
                        placeholder="Nhập tổng số câu hỏi của cơ cấu đề thi">
                </div>
                <div class="col-2">
                    <input type="text" name="exam_structure_ez[]" class="form-control" placeholder="Nhập số câu dễ">
                </div>
                <div class="col-2">
                    <input type="text" name="exam_structure_me[]" class="form-control" placeholder="Nhập số câu trung bình">
                </div>
                <div class="col-2">
                    <input type="text" name="exam_structure_ha[]" class="form-control" placeholder="Nhập số câu khó">
                </div>
            </div>
            `;
            $('.div-examStructute').append(listExamStructure);
        }else{
            alert('Không được thêm quá 10 chương');
        }
    });

    $('#delete').on('click', function() {
    $('.exam_structure-div').last().remove()

    });
});
</script>
@endpush