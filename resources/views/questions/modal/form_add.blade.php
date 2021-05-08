<div class="modal fade" id="modal-lg-add" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm câu hỏi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quickForm" method="POST"
                    action="{{ route('questions.store') }}">
                    @csrf
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
                            <label for="exampleInputPassword1">Loai câu hỏi</label>
                            <input type="text" name="question_type" class="form-control" id="exampleInputPassword1" placeholder="Loai câu hỏi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mức câu hỏi</label>
                            <input type="text" name="question_level" class="form-control" id="exampleInputPassword1" placeholder="Mức độ câu hỏi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc chương</label>
                            <select class="form-control" name="chapter_id">
                                @foreach ($data['chapters'] as $item)
                                    <option value="{{$item['chapter_id']}}">{{ $item['chapter_name'] }}</option>
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