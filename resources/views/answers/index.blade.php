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
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID đáp án</th>
                        <th>Đáp án</th>
                        <th>Đáp án đúng</th>
                        <th>Trạng thái</th>
                        <th>Thuộc câu hỏi</th>
                        <th>Thuộc đề this</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $item)
                        <tr>
                            <td>{{ $item['answer_id'] }}</td>
                            <td>{{$item['answer_content']}}</td>
                            <td>
                                @if ($item['answer_correct'] == 0)
                                    <input type="checkbox" name="" id="" data-id="{{$item['answer_id']}}" class="changeCorrect">
                                @else
                                    <input type="checkbox" name="" id="" data-id="{{$item['answer_id']}}" checked class="changeCorrect">
                                @endif
                            </td>
                            <td>
                                @if ($item['answer_active'] == 0)
                                <input type="checkbox" name="" id="" data-id="{{$item['answer_id']}}" class="changeActive">
                                @else
                                <input type="checkbox" name="" id="" data-id="{{$item['answer_id']}}" checked class="changeActive">
                                @endif
                            </td>
                            <td>{{$item['answer_active']}}</td>
                            <td>{{$item->question['question_name']}}</td>
                            <td></td>
                            <td>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg-edit{{$item['answer_id']}}">Edit </a>
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $item['answer_id'] }}">
                                    Delete
                                </button>
                            </td>
                            @include('answers.modal.form_edit',['answers' => $answers,'dataQuestions' => $data['questions'],'dataExams' => $data['exams']])
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
        $('.changeCorrect').click(function() {
            var answerId = $(this).data('id');
            Swal.fire({
            title: 'Do you want change correct answer ?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            }).then((result) => {
            $.ajax({
            type: "GET",
            url: "answers/changeCorrect/"+answerId,
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
        $('.changeActive').click(function() {
        var answerId = $(this).data('id');
        Swal.fire({
        title: 'Do you want change active answer ?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
        }).then((result) => {
        $.ajax({
        type: "GET",
        url: "answers/changeActive/"+answerId,
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
        $(".btn-delete").click(function() {
          var answerId = $(this).data('id');
          Swal.fire({
          title: 'Do you want dele?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Yes`,
          denyButtonText: `No`,
          }).then((result) => {
            $.ajax({
                type: "GET",
                url: "answers/delete/"+answerId,
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