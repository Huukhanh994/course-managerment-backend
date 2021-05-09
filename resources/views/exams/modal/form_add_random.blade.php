<div class="modal fade" id="modal-lg-add-random" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm đề thi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="quickForm" method="POST"
                action="{{ route('exams.storeRandom') }}">
                @csrf
            <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn cấu trúc</label>
                            <select class="form-control" name="exam_structure_id">
                                @foreach ($data as $item)
                                    <option value="{{$item['exam_structure_id']}}">{{ $item['exam_structure_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>