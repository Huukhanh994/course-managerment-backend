<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function index()
    {
        $answers = Answer::with(['question', 'exam'])->get();
        $data = [];
        $data['questions'] = Question::all();
        $data['exams'] = Exam::all();
        return view('answers.index', compact('answers', 'data'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        if (isset($input['answer_correct']) && $input['answer_correct'] == 'on') {
            $input['correct'] = 1;
        } else {
            $input['correct'] = 0;
        }

        if (isset($input['answer_active']) && $input['answer_active'] == 'on') {
            $input['active'] = 1;
        } else {
            $input['active'] = 0;
        }

        $result = Answer::create([
            'answer_content' => $input['answer_content'],
            'answer_correct' => $input['correct'],
            'answer_active' => $input['active'],
            'exam_id' => $input['exam_id'],
            'question_id' => $input['question_id'],
        ]);

        if ($result) {
            return redirect()->route('answers.index')->with('success', 'Thêm đáp án thành công');
        } else {
            return redirect()->route('answers.index')->with('error', 'Thêm đáp án thất bại');
        }
    }

    public function delete(Request $request)
    {
        $delete = Answer::whereAnswerId($request->answerId)->delete();

        if ($delete) {
            return response()->json(['success' => "Xóa đáp án thành công !"]);
        } else {
            return response()->json(['error' => 'Xóa đáp án thất bại!']);
        }
    }

    public function changeCorrect(Request $request)
    {
        $isActive = Answer::whereAnswerId($request->answerId)->value('answer_correct');
        $result = Answer::whereAnswerId($request->answerId)->update([
            'answer_correct' => !$isActive
        ]);

        if ($result) {
            return response()->json(['success' => 'Cập nhật thành công']);
        } else {
            return response()->json(['error' => 'Cập nhật thất bại']);
        }
    }

    public function changeActive(Request $request)
    {
        $isActive = Answer::whereAnswerId($request->answerId)->value('answer_active');
        $result = Answer::whereAnswerId($request->answerId)->update([
            'answer_active' => !$isActive
        ]);

        if ($result) {
            return response()->json(['success' => 'Cập nhật thành công']);
        } else {
            return response()->json(['error' => 'Cập nhật thất bại']);
        }
    }

    public function update(Answer $answer, Request $request)
    {
        $input = $request->except('_token');

        $result = $this->answerRepository->updateAnswer($input, $answer['answer_id']);

        if ($result) {
            return redirect()->route('answers.index')->with('success', 'Cập nhật thành công');
        } else {
            return back()->with('error', 'Cập nhật thất bại');
        }
    }
}
