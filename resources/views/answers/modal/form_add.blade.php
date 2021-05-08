<div class="modal fade" id="modal-lg-add" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa đáp án</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('answers.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thuộc câu hỏi</label>
                                <select name="question_id" id="" class="form-control">
                                    @foreach ($data['questions'] as $item)
                                    <option value="{{$item['question_id']}}">{{$item['question_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thuộc đề</label>
                                <select name="exam_id" id="" class="form-control">
                                    @foreach ($data['exams'] as $item)
                                    <option value="{{$item['exam_id']}}">{{$item['exam_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đáp án</label>
                                <input type="text" class="form-control" name="answer_content" id="exampleInputEmail1" placeholder="Nhâp đáp án">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="answer_correct" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Đáp án đúng</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="answer_active" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Trạng thái</label>
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