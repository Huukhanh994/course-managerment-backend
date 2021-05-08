@extends('layouts.app')

@section('body.content')
    
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Cấu trúc đề thi của {{ $exam['exam_name'] }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{ route('exam_structures.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Cấu trúc đề thi
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($randomQuestions) && count($randomQuestions) > 0)
                                @foreach ($randomQuestions as $question)
                                    <input type="hidden" name="questions[]" value="{{$question}}">
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ $question['question_code'] }} - {{$question['question_name']}}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($question->answers as $item)
                                                    <div class="col-3">
                                                        @if ($item['answer_correct'] == 1)
                                                            <input type="text" class="form-control is-valid" id="inputSuccess" name="answer_content[]" value="{{$item['answer_content']}}">
                                                        @else
                                                            <input type="text" class="form-control" name="answer_content[]" value="{{$item['answer_content']}}">
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="answers" value="{{$question->answers}}">
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                @endforeach
                            @else
                                <ol>
                                    @foreach ($exam->questions as $question)
                                    <input type="hidden" name="questions[]" value="{{$question}}">
                                    <li>{{$question['question_code']}} - {{ $question['question_name'] }}</li>
                                    <ol style="padding-left: 40px;">
                                        @foreach ($question->answers as $item)
                                        <li>
                                            @if ($item['answer_correct'] == 1)
                                            <span class="badge badge-success">{{ $item['answer_content'] }}</span>
                                            @else
                                            <span class="badge badge-secondary">{{$item['answer_content']}}</span>
                                            @endif
                                        </li>
                                        <input type="hidden" name="answers" value="{{$question->answers}}">
                                        @endforeach
                                    </ol>
                                    @endforeach
                                </ol>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Download</button>
        </div>
    </form>
</div>
@endsection