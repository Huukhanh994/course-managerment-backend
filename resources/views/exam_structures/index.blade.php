@extends('layouts.app')

@section('title')
Môn học
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
        <div class="modal-content">
            <form action="{{route('subjects.store')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm môn học</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Tên môn học</span>
                    <input type="text" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="button" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>


<table class="table table-hover" id="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên môn</th>
            <th scope="col">Chương</th>
            <th scope="col">Số câu dễ</th>
            <th scope="col">Số câu trung bình</th>
            <th scope="col">Số câu khó</th>
            <th scope="col">Tuỳ chọn</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>
                <a href="" class="select-action-pratice-test" target="_blank" data-practest-id="" idAction=1>
                    <i class="fas fa-edit"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="color:red;" class="remove" idAction=2 data-practest-id="">
                    <i class="far fa-trash-alt"></i>
                </a>
            </td>
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