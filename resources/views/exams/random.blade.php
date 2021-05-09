@extends('layouts.app')

@section('body.content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cấu trúc đề thi của</h3>
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
                                    Cấu trúc đề thiád
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @foreach ($data['ez'] as $questionEz)
                                <input type="hidden" name="questions[]" value="{{$questionEz}}">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $questionEz['question_code'] }} -
                                            {{$questionEz['question_name']}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($questionEz->answers as $item)
                                            <div class="col-3">
                                                @if ($item['answer_correct'] == 1)
                                                <input type="text" class="form-control is-valid" id="inputSuccess"
                                                    name="answer_content[{{$questionEz['question_name']}}][]" value="{{$item['answer_content']}}">
                                                @else
                                                <input type="text" class="form-control" name="answer_content[{{$questionEz['question_name']}}][]"
                                                    value="{{$item['answer_content']}}">
                                                @endif
                                            </div>
                                            <input type="hidden" name="answers[{{$questionEz['question_name']}}][]" value="{{$item['answer_content']}}">
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                @endforeach
                            </div>
                            <div class="card-body">
                                @foreach ($data['me'] as $questionEz)
                                <input type="hidden" name="questions[]" value="{{$questionEz}}">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $questionEz['question_code'] }} -
                                            {{$questionEz['question_name']}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($questionEz->answers as $item)
                                            <div class="col-3">
                                                @if ($item['answer_correct'] == 1)
                                                <input type="text" class="form-control is-valid" id="inputSuccess" name="[{{$questionEz['question_name']}}][]"
                                                    value="{{$item['answer_content']}}">
                                                @else
                                                <input type="text" class="form-control" name="[{{$questionEz['question_name']}}][]" value="{{$item['answer_content']}}">
                                                @endif
                                            </div>
                                            <input type="hidden" name="answers[{{$questionEz['question_name']}}][]" value="{{$item->answer_content}}">
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                @endforeach
                            </div>
                            <div class="card-body">
                                @foreach ($data['ha'] as $questionEz)
                                <input type="hidden" name="questions[]" value="{{$questionEz}}">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $questionEz['question_code'] }} -
                                            {{$questionEz['question_name']}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($questionEz->answers as $item)
                                            <div class="col-3">
                                                @if ($item['answer_correct'] == 1)
                                                <input type="text" class="form-control is-valid" id="inputSuccess" name="[{{$questionEz['question_name']}}][]"
                                                    value="{{$item['answer_content']}}">
                                                @else
                                                <input type="text" class="form-control" name="[{{$questionEz['question_name']}}][]" value="{{$item['answer_content']}}">
                                                @endif
                                            </div>
                                            <input type="hidden" name="answers[{{$questionEz['question_name']}}][]" value="{{$item->answer_content}}">
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                @endforeach
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