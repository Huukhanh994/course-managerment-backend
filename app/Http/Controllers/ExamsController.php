<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamStructure;
use Illuminate\Http\Request;
use App\Repositories\ExamRepository;
use App\Models\Question;

class ExamsController extends Controller
{
    protected $examRepository;
    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }
    public function index()
    {
        $exams = Exam::with('questions.answers')->get();
        $data = $this->examRepository->prepareData();
        return view('exams.index', compact('exams', 'data'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');

        $result = $this->examRepository->storeExam($input);

        if ($result) {
            return redirect()->route('exams.index')->with('success', 'Thêm đề thi thành công!');
        } else {
            return back()->with('error', 'Thêm đề thi thất bại');
        }
    }

    public function delete(Request $request)
    {
        $delete = Exam::whereExamId($request->examId)->delete();

        if ($delete) {
            return response()->json(['success' => 'Xóa đề thi thành công']);
        } else {
            return response()->json(['error' => 'Xóa đề thi thất bại']);
        }
    }

    public function storeRandom(Request $request)
    {
        $examStructure = ExamStructure::whereExamStructureId($request->exam_structure_id)->first();
        $data = [];
        if (isset($examStructure['exam_structure_ez'])) {
            $data['ez'] = Question::with('answers')->where('question_level', '=', 'Dễ')->inRandomOrder()->limit($examStructure['exam_structure_ez'])->get();
        }
        if (isset($examStructure['exam_structure_me'])) {
            $data['me'] = Question::with('answers')->where('question_level', '=', 'Trung bình')->inRandomOrder()->limit($examStructure['exam_structure_me'])->get();
        }
        if (isset($examStructure['exam_structure_ha'])) {
            $data['ha'] = Question::with('answers')->where('question_level', '=', 'Khó')->inRandomOrder()->limit($examStructure['exam_structure_ha'])->get();
        }
        return view('exams.random', compact('data'));
    }
}
