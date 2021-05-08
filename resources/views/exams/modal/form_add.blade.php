<div class="modal fade" id="modal-lg-add" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm đề thi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quickForm" method="POST"
                    action="{{ route('exams.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã đề</label>
                            {!! Form::text("exam_code", '', ["class"=>"form-control", "id"=>"exampleInputEmail1",
                            "placeholder"=>"Mã đề"]) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên đề</label>
                            <input type="text" name="exam_name" class="form-control" id="exampleInputPassword1"
                                placeholder="Tên đề">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Loai đề</label>
                            <input type="text" name="exam_type" class="form-control" id="exampleInputPassword1" placeholder="Loai đề">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thời gian làm bài</label>
                            <input type="text" name="exam_end_time" class="form-control" id="exampleInputPassword1" placeholder="Mức độ đề">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn đề</label>
                            <select multiple="" class="form-control" name="question_id[]">
                                @foreach ($data as $item)
                                    <option value="{{$item['question_id']}}">{{ $item['question_name'] }}</option>
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