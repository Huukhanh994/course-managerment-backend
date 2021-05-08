<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        $questions = $this->questionRepository->all();
        $data = $this->questionRepository->prepareData();
        return view('questions.index', compact('questions'))->with('data', $data);
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');

        $create = $this->questionRepository->create($input);

        if ($create) {
            return back()->with('success', 'Cập nhật dữ liệu thành công!');
        } else {
            return back()->with('error', 'Cập nhật dữ liệu thất bại!');
        }
    }

    public function update(Question $question, Request $request)
    {
        $input = $request->except('_token');
        $update = $this->questionRepository->update($input, $question['question_id']);

        if ($update) {
            return back()->with('success', 'Cập nhật dữ liệu thành công!');
        } else {
            return back()->with('error', 'Cập nhật dữ liệu thất bại!');
        }
    }

    public function delete(Request $request)
    {
        $delete = Question::whereQuestionId($request->questionId)->delete();

        if ($delete) {
            return response()->json(['success' => 'Xóa câu hỏi thành công']);
        } else {
            return response()->json(['error' => 'Xóa câu hỏi thất bại']);
        }
    }

    public function addAnswers(Question $question)
    {
        return view('questions.answers.add', compact('question'));
    }

    public function storeAnswers(Question $question, Request $request)
    {
        $input = $request->except('_token');
        foreach ($input['answer_content'] as $key => $value) {
            Answer::create([
                'answer_content' => $value,
                'answer_active' => '1',
                'question_id' => $question['question_id']
            ]);
        }

        return back()->with('success', 'Thêm đáp án cho câu hỏi thành công');
    }
}
