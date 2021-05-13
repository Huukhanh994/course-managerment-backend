@extends('layouts.app')
@push('body.head')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@section('body.content')
<div class="card">
    <div class="card-header">
        <a href="#" class="btn btn-info" data-toggle="modal"
            data-target="#modal-lg-add">Thêm</a>
        <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-lg-add-random">Thêm câu hỏi theo cơ cấu đề</a>
        @include('exams.modal.form_add_random',['data' => $data['examStructures']])
        @include('exams.modal.form_add',['data' => $data['questions']])
        @include('exams.modal.form_random_questions',['exams' => $exams,'examStructures' => $examStructures])
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID đề thi</th>
                    <th>Mã đề</th>
                    <th>Tên đề</th>
                    <th>Loại đề</th>
                    <th>Thời gian kết thúc</th>
                    <th>Câu hỏi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $item)
                <tr>
                    <td>{{ $item['exam_id'] }}</td>
                    <td>{{ $item['exam_code'] }}</td>
                    <td>{{ $item['exam_name'] }}</td>
                    <td>{{ $item['exam_type'] }}</td>
                    <td>{{ $item['exam_end_time'] }}</td>
                    <td>
                        <ol>
                            @foreach ($item->questions as $key => $ques)
                                <li><b>{{$key+1}}/</b>  {{ $ques['question_name'] }}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <a href="{{ route('exam_structures.show',$item['exam_id']) }}" class="btn btn-success">Xem cấu trúc đề thi</a>
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-lg-random{{$item['exam_id']}}">Thêm câu hỏi tự
                          động</a>
                        <a href="{{route('exam_structures.downloadPdf',$item['exam_id'])}}" class="btn btn-dark">PDF</a>
                        <a href="#" class="btn btn-warning"
                            data-toggle="modal" data-target="#modal-lg-edit{{$item['exam_id']}}">Edit</a>
                        <button type="button" class="btn btn-danger btn-delete" data-id="{{ $item['exam_id'] }}">
                            Delete
                        </button>
                    </td>
                    @include('exams.modal.form_edit',['exams' => $exams,'examStructures' => $examStructures])
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('body.scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Vietnamese.json"
            },
            "order": [[ 0, "asc" ]],
            "bPaginate": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Vietnamese.json"
            },
            "order": [[ 0, "asc" ]],
            "bPaginate": false,
        });
      });
</script>
<!-- Page specific script -->
<script>
    $(function () {
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#quickForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 5
          },
          terms: {
            required: true
          },
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>

<script>
    $(document).ready(function () {
        $(".btn-delete").click(function() {
          var examId = $(this).data('id');
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
          url: "exams/delete/"+examId,
          data: {_token: CSRF_TOKEN},
          dataType: 'JSON',
          success: function (response) {
          
          if (response.success === true) {
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
      });
</script>
@endpush