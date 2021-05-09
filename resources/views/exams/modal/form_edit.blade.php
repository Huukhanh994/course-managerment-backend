@foreach ($exams as $item)
    <div class="modal fade" id="modal-lg-edit{{ $item['exam_id'] }}" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa đáp án</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" method="POST"
                        action="{{ route('exams.update',!empty($item['exam_id']) ? $item['exam_id'] : null) }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã đề</label>
                                {!! Form::text("exam_code", $item['exam_code'], ["class"=>"form-control", "id"=>"exampleInputEmail1",
                                "placeholder"=>""]) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên đề</label>
                                {!! Form::text("exam_name", $item['exam_name'], ["class"=>"form-control", "id"=>"exampleInputEmail1",
                                "placeholder"=>""]) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Loại đề</label>
                                @php
                                    $arrType = ["Dễ","Trung Bình",'Khó'];
                                @endphp
                                <select name="exam_type" id="exam_type" class="form-control">
                                    @foreach ($arrType as $key => $val)
                                        @if ($item['exam_type'] == $val )
                                            <option value="{{$val}}" selected>{{$val}}</option>
                                        @else
                                            <option value="{{$val}}">{{$val}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thời gian làm bài</label>
                                <select name="exam_end_time" id="exam_end_time" class="form-control">
                                    @php
                                        $arrEndTime = ["10","15",'45'];
                                    @endphp
                                    @foreach ($arrEndTime as $key => $val)
                                        @if ($item['exam_end_time'] == $val )
                                            <option value="{{$val}}" selected>{{$val}}</option>
                                        @else
                                            <option value="{{$val}}">{{$val}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thuộc câu hỏi</label>
                                <select name="exam_structure_id" id="" class="form-control">
                                    @foreach ($examStructures as $val)
                                        @if ($item['exam_structure_id'] === $val['exam_structure_id'])
                                            <option value="{{$val['exam_structure_id']}}" selected>{{$val['exam_structure_name']}}</option>
                                        @else
                                            <option value="{{$val['exam_structure_id']}}">{{$val['exam_structure_name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach