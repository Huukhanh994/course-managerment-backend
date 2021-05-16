<div class="modal fade" id="modal-lg-add" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm câu hỏi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="quickForm" method="POST" action="{{ route('questions.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã câu hỏi</label>
                            {!! Form::text("question_code", '', ["class"=>"form-control", "id"=>"exampleInputEmail1",
                            "placeholder"=>"Mã câu hỏi"]) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên câu hỏi</label>
                            <input type="text" name="question_name" class="form-control" id="exampleInputPassword1"
                                placeholder="Tên câu hỏi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mức độ câu hỏi</label>
                            <select name="question_level" id="" class="form-control">
                                <option value="Dễ">Dễ</option>
                                <option value="Trung Bình">Trung bình</option>
                                <option value="Khó">Khó</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc môn</label>
                            <select class="form-control select-subject" name="subject_id">
                                <option value="">--Chọn Môn--</option>
                                @foreach ($data['subjects'] as $item)
                                <option value="{{$item['subject_id']}}">{{ $item['subject_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc chương</label>
                            <select class="form-control select-chapter" name="chapter_id">
                                <option value="">--Chọn Chương--</option>
                                @foreach ($data['chapters'] as $item)
                                <option value="{{$item['chapter_id']}}">{{ $item['chapter_name'] }}</option>
                                @endforeach
                                
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