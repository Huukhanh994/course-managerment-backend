@extends('layouts.app')

@section('title')
Môn học
@endsection
@section('body.content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary">
    Thêm câu hỏi
</button>



<table class="table table-hover" id="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Câu hỏi</th>
            <th scope="col">Đáp án</th>
            <th scope="col">Tuỳ chọn</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td><i class="fas fa-check"></i> A <br>
                B <br>
                C <br>
                D</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <td scope="row">3</td>
            <td colspan="2">Larry the Bird</td>
            <td> <a href="" class="select-action-pratice-test" target="_blank" data-practest-id="" idAction=1>
                    <i class="fas fa-edit"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="color:red;" class="remove" idAction=2 data-practest-id="">
                    <i class="far fa-trash-alt"></i>
                </a></td>
        </tr>
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