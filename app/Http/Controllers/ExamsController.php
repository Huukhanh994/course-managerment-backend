<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Repositories\ExamRepository;

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
}
