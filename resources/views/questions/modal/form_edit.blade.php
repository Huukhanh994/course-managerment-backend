@foreach ($questions as $item)
    <div class="modal fade" id="modal-lg-edit{{ $item['question_id'] }}" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa câu hỏi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" method="POST"
                        action="{{ route('questions.update',!empty($item['question_id']) ? $item['question_id'] : null) }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã câu hỏi</label>
                                {!! Form::text("question_code", $item['question_code'], ["class"=>"form-control", "id"=>"exampleInputEmail1",
                                "placeholder"=>"Enter email"]) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tên câu hỏi</label>
                                <input type="text" name="question_name" class="form-control" id="exampleInputPassword1" placeholder="Tên câu hỏi" value="{{ $item['question_name'] }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Loai câu hỏi</label>
                                <input type="text" name="question_type" class="form-control" id="exampleInputPassword1" placeholder="Tên câu hỏi"value="{{ $item['question_type'] }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mức độ câu hỏi</label>
                                <input type="text" name="question_level" class="form-control" id="exampleInputPassword1" placeholder="Tên câu hỏi"value="{{ $item['question_level'] }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thuộc chương</label>
                                <select name="chapter_id" id="" class="form-control">
                                    @foreach ($data['chapters'] as $val)
                                        @if ($item['chapter_id'] == $val['chapter_id'])
                                            <option value="{{ $val['chapter_id'] }}" selected>{{ $val['chapter_name'] }}</option>
                                        @else
                                            <option value="{{ $val['chapter_id'] }}">{{ $val['chapter_name'] }}</option>
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