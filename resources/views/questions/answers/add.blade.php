@extends('layouts.app')

@section('body.content')
    <form action="{{ route('questions.answers.store',$question['question_id']) }}" method="POST">
        @csrf
        <!-- TO DO List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Thêm đáp án
                </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    @if (count($question->answers) > 0)
                        @foreach ($question->answers as $key => $item)
                        <li id="item_{{$key+1}}" class="answer-div">
                            <!-- drag handle -->
                            <span class="handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <!-- checkbox -->
                            <div class="form-group">
                                <input type="text" value="{{ $item['answer_content'] }}" name="answer_content[]" id="" class="form-control">
                            </div>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <i class="fas fa-edit"></i>
                                <i class="fas fa-trash-o"></i>
                            </div>
                        </li>
                        @endforeach
                    @else
                        <li id="item_1" class="answer-div">
                            <!-- drag handle -->
                            <span class="handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <!-- checkbox -->
                            <div class="form-group">
                                <input type="text" value="" name="answer_content[]" id="" class="form-control">
                            </div>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                                <i class="fas fa-edit"></i>
                                <i class="fas fa-trash-o"></i>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right" id="add-item"><i class="fas fa-plus"></i> Thêm đáp án</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection

@push('body.scripts')
    <script>
        $(document).ready(function () {
            $('#add-item').on('click', function(){
                var totalElement = $('.answer-div').length;
                var max = 4;
                var lastId = $(".answer-div:last").attr("id");
                var splitId = lastId.split("_");
                var nextIndex = Number(splitId[1]) + 1;
                
                if(totalElement < max){ 
                    let listAnswer=`
                        <li id="item_${nextIndex}" class="answer-div">
                        <span class="handle">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <div class="form-group">
                            <input type="text" value="" name="answer_content[]" id="" class="form-control">
                        </div>
                        <span class="text"></span>
                        <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    `;
                    $('.todo-list').append(listAnswer);
                }else{
                    alert('Chỉ được thêm maxium là 4 câu trả lời.');
                }
            });
        });
    </script>
@endpush