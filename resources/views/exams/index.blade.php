@extends('layouts.app')
@push('body.head')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@section('body.content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('questions.form') }}" class="btn btn-info" data-toggle="modal"
            data-target="#modal-lg-add">Add</a>
        @include('exams.modal.form_add',['data' => $data['questions']])
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
                        <ul>
                            @foreach ($item->questions as $ques)
                                <li>{{ $ques['question_name'] }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('exam_structures.show',$item['exam_id']) }}" class="btn btn-success">Xem cấu trúc đề thi</a>
                        <a href="{{ route('exam_structures.random',$item['exam_id']) }}" class="btn btn-info">Tạo đề thi ngẫu nhiên</a>
                          <a href="{{route('exam_structures.downloadPdf',$item['exam_id'])}}" class="btn btn-dark">PDF</a>
                        <a href="#" class="btn btn-warning"
                            data-toggle="modal" data-target="#modal-lg-edit">Edit</a>
                        <button type="button" class="btn btn-danger btn-delete" data-id="{{ $item['exam_id'] }}">
                            Delete
                        </button>
                    </td>
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
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
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
          title: 'Do you want dele?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Yes`,
          denyButtonText: `No`,
          }).then((result) => {
            $.ajax({
                type: "GET",
                url: "exams/delete/"+examId,
                success: function (response) {
                  /* Read more about isConfirmed, isDenied below */
                  if (response.success) {
                  Swal.fire('Saved!', '', 'success')
                  } else if (response.error) {
                  Swal.fire('Changes are not saved', '', 'info')
                  }
                }
              });
          })
        })
      });
</script>
@endpush