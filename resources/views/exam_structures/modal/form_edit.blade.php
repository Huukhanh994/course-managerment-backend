@foreach ($examStructures as $item)
<div class="modal fade modal-lg-edit{{ $item['exam_structure_id'] }}" id="modal-lg-edit" class="" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa đáp án</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="quickForm" method="POST"
                action="{{ route('exam_structures.update',!empty($item['exam_structure_id']) ? $item['exam_structure_id'] : null) }}">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên cấu trúc</label>
                            {!! Form::text("exam_structure_name", $item['exam_structure_name'],
                            ["class"=>"form-control", "id"=>"exampleInputEmail1",
                            "placeholder"=>""]) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng câu hỏi</label>
                            {!! Form::text("exam_structure_quantity", $item['exam_structure_quantity'],
                            ["class"=>"form-control",
                            "id"=>"exampleInputEmail1",
                            "placeholder"=>""]) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số câu hỏi dễ</label>
                            {!! Form::text("exam_structure_ez", $item['exam_structure_ez'], ["class"=>"form-control",
                            "id"=>"exampleInputEmail1",
                            "placeholder"=>""]) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số câu hỏi trung bình</label>
                            {!! Form::text("exam_structure_me", $item['exam_structure_me'], ["class"=>"form-control",
                            "id"=>"exampleInputEmail1",
                            "placeholder"=>""]) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số câu hỏi khó</label>
                            {!! Form::text("exam_structure_ha", $item['exam_structure_ha'], ["class"=>"form-control",
                            "id"=>"exampleInputEmail1",
                            "placeholder"=>""]) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc câu hỏi</label>
                            <select name="chapter_id" id="" class="form-control">
                                @foreach ($data as $val)
                                @if ($item->chapter['chapter_id'] == $val['chapter_id'])
                                <option value="{{$val['chapter_id']}}" selected>{{$val['chapter_name']}}</option>
                                @else
                                <option value="{{$val['chapter_id']}}">{{$val['chapter_name']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach