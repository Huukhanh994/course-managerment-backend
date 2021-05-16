@extends('layouts.app')
@push('body.head')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@section('body.content')
<div class="card">
  <div class="card-header">
    <a href="{{ route('questions.form') }}" class="btn btn-info" data-toggle="modal"
      data-target="#modal-lg-add">Thêm</a>
    @include('questions.modal.form_add')
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID câu hỏi</th>
          <th>Mã câu hỏi</th>
          <th>Tên câu hỏi</th>
          <th>Mức câu hỏi</th>
          <th>Thuộc chương</th>
          <th>Tuỳ chọn</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $item)
        <tr>
          <td>{{ $item['question_id'] }}</td>
          <td>{{ $item['question_code'] }}</td>
          <td>{{ $item['question_name'] }}</td>
          <td>@switch( $item['question_level'])
            @case('Dễ')
            Dễ
            @break
            @case('Trung Bình')
            Trung bình
            @break
            @case('Khó')
            Khó
            @break
            @endswitch</td>
          <td>{{ $item->chapter->chapter_name }}</td>
          <td>
            <a href="{{ route('questions.answers.add',$item['question_id']) }}" class="btn btn-success">Thêm đáp án</a>
            <a href="{{ route('questions.form',$item['question_id']) }}" class="btn btn-warning" data-toggle="modal"
              data-target="#modal-lg-edit{{$item['question_id']}}">Sửa</a>
            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $item['question_id'] }}">
              Xoá
            </button>
          </td>
        </tr>
        @endforeach
        @include('questions.modal.form_edit',['questions' => $questions,'data' => $data])
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
        $(".select-subject").change(function (e) { 
          e.preventDefault();
          let id= $(this).val();
          $.ajax({
            type: "GET",
            url: "chapters/"+id+"/get-chapter",
            success: function (response) {
              let option=""
              $.each(response, function (indexInArray, valueOfElement) { 
                console.log(valueOfElement);
                option+="<option value="+valueOfElement.chapter_id+">"+valueOfElement.chapter_name+"</option>"
              });
              $(".select-chapter").html(option);
                }
              });
        });

        $(".btn-delete").click(function() {
          var questionId = $(this).data('id');
          Swal.fire({
          title: 'Do you want dele?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Yes`,
          denyButtonText: `No`,
          }).then((result) => {
            $.ajax({
                type: "GET",
                url: "questions/delete/"+questionId,
                success: function (response) {
                  /* Read more about isConfirmed, isDenied below */
                  if (response.success) {
                  Swal.fire('Saved!', response.success, 'success')
                  } else if (response.error) {
                  Swal.fire('Changes are not saved', response.error, 'error')
                  }
                }
              });
          })
        })
      });
</script>
@endpush