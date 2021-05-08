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
            <form id="quickForm" method="POST"
                action="{{ route('questions.update',!empty($item['question_id']) ? $item['question_id'] : null) }}">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã câu hỏi</label>
                            {!! Form::text("question_code", $item['question_code'], ["class"=>"form-control",
                            "id"=>"exampleInputEmail1",
                            "placeholder"=>"Enter email"]) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên câu hỏi</label>
                            <input type="text" name="question_name" class="form-control" id="exampleInputPassword1"
                                placeholder="Tên câu hỏi" value="{{ $item['question_name'] }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mức độ câu hỏi</label>
                            <select name="question_level" id="" class="form-control">
                                <option value="1" @if ($item['question_level']==1) selected @endif>Dễ</option>
                                <option value="2" @if ($item['question_level']==2) selected @endif>Trung bình</option>
                                <option value="3" @if ($item['question_level']==3) selected @endif>Khó</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc Môn</label>
                            <select name="subject_id" id="" class="form-control select-subject">
                                @foreach ($data['subjects'] as $val)
                                @if ($item['subject_id'] == $val['subject_id'])
                                <option value="{{ $val['subject_id'] }}" selected>{{ $val['subject_name'] }}</option>
                                @else
                                <option value="{{ $val['subject_id'] }}">{{ $val['subject_name'] }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc chương</label>
                            <select class="form-control select-chapter" name="chapter_id">
                                <option value="">--Chọn Chương--</option>


                            </select>
                        </div>
                    </div>
                </div>
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