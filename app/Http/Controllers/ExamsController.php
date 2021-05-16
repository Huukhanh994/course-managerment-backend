<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamStructure;
use App\Models\Question;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;

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
        $data['questions'] = Question::all();
        $data['examStructures'] = ExamStructure::select('exam_structure_name')->groupBy('exam_structure_name')->get();

        $examStructures = ExamStructure::all();
        return view('exams.index', compact('exams', 'data', 'examStructures'));
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
        $input = $request->except('_token');
        $examStructure = ExamStructure::where('exam_structure_name', $request->exam_structure_name)->get();
        $exam = Exam::create([
            'exam_code' => $input['exam_code'],
            'exam_name' => $input['exam_name'],
            'exam_type' => $input['exam_type'],
            'exam_end_time' => $input['exam_end_time'],
            // 'exam_structure_name' => $input['exam_structure_name'],
        ]);
        $data = [];
        foreach ($examStructure as $key => $value) {
            if (isset($value['exam_structure_ez'])) {
                $data['ez'][$key] = Question::with('answers')->where('question_level', '=', 'Dễ')
                ->where('chapter_id',$value['chapter_id'])
                ->inRandomOrder()->limit($value['exam_structure_ez'])
                ->get();

                $exam->questions()->sync($data['ez'][$key]);
            }
            if (isset($value['exam_structure_me'])) {
                $data['me'][$key] = Question::with('answers')->where('question_level', '=', 'Trung bình')
                ->where('chapter_id',$value['chapter_id'])
                ->inRandomOrder()->limit($value['exam_structure_me'])
                ->get();

                $exam->questions()->sync($data['me'][$key]);
            }
            if (isset($value['exam_structure_ha'])) {
                $data['ha'][$key] = Question::with('answers')->where('question_level', '=', 'Khó')
                ->where('chapter_id',$value['chapter_id'])
                ->inRandomOrder()->limit($value['exam_structure_ha'])
                ->get();

            $exam->questions()->sync($data['ha'][$key]);
            }
    

        }
        return view('exams.random', compact('data', 'input'));
    }

    public function update(Exam $exam, Request $request)
    {
        $input = $request->except('_token');

        $result = $this->examRepository->updateExam($input, $exam['exam_id']);

        if ($result) {
            return redirect()->route('exams.index')->with('success', 'Cập nhật đề thi thành công');
        } else {
            return redirect()->route('exams.index')->with('error', 'Cập nhật thất bại');
        }
    }
}
