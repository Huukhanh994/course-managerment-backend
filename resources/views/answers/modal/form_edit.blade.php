@foreach ($answers as $item)
    <div class="modal fade" id="modal-lg-edit{{ $item['answer_id'] }}" style="display: none;" aria-hidden="true">
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
                        action="{{ route('answers.update',!empty($item['answer_id']) ? $item['answer_id'] : null) }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đáp án</label>
                                {!! Form::text("answer_content", $item['answer_content'], ["class"=>"form-control", "id"=>"exampleInputEmail1",
                                "placeholder"=>""]) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thuộc câu hỏi</label>
                                <select name="question_id" id="" class="form-control">
                                    @foreach ($dataQuestions as $val)
                                        @if ($item->question['question_id'] == $val['question_id'])
                                        <option value="{{$val['question_id']}}" selected>{{$val['question_name']}}</option>
                                        @else
                                        <option value="{{$val['question_id']}}">{{$val['question_name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thuộc đề thi</label>
                                <select name="exam_id" id="" class="form-control">
                                    @foreach ($dataExams as $val)
                                        @if ($item->question['exam_id'] == $val['exam_id'])
                                        <option value="{{$val['exam_id']}}" selected>{{$val['exam_name']}}</option>
                                        @else
                                        <option value="{{$val['exam_id']}}">{{$val['exam_name']}}</option>
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