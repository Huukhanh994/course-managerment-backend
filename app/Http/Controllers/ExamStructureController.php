<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamStructure;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use PDF;

class ExamStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examStructures = ExamStructure::all();
        $data = Subject::all();
        $result = Subject::with('chapters')->get()->toArray();
        return view('exam_structures.index', compact('examStructures', 'data', 'result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $question = $request->get('questions');
        $description = $request->get('answers');
        // dd($request);
        // $section->addImage("http://itsolutionstuff.com/frontTheme/images/logo.png");
        foreach ($question as $key1 => $value) {
            foreach ($value as $key2 => $value2) {
                $section->addText('' . $value2);
                $text = '';
                foreach ($description[$key1] as $key3 => $value3) {
                    $text .= $value3 . '     ';
                }
                $section->addText('' . $text);
            }
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path('helloWorld.docx'));
    }

    public function storeExamStructure(Request $request)
    {
        $input = $request->except('_token');
        $unique=ExamStructure::where('exam_structure_name',$input['exam_structure_name'])->first();
        if($unique){
            return back()->with('error','M?? ????? n??y ???? c??');
        }
        for ($i = 0; $i < count($input['chapter_id']); $i++) {
            $examStructures = ExamStructure::create([
                'exam_structure_quantity' => $input['exam_structure_quantity'][$i],
                'exam_structure_name' => $input['exam_structure_name'],
                'exam_structure_ez' => $input['exam_structure_ez'][$i],
                'exam_structure_me' => $input['exam_structure_me'][$i],
                'exam_structure_ha' => $input['exam_structure_ha'][$i],
                'chapter_id' => $input['chapter_id'][$i],
            ]);
        }
        if ($examStructures) {
            return redirect()->route('exam_structures.index')->with('success', 'Th??m c???u tr??c ????? th??nh c??ng');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::with('questions')->whereExamId($id)->first();
        return view('exam_structures.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token');
        $result = ExamStructure::whereExamStructureId($id)->update([
            'exam_structure_name' => $input['exam_structure_name'],
            'exam_structure_quantity' => $input['exam_structure_quantity'],
            'exam_structure_ez' => $input['exam_structure_ez'],
            'exam_structure_me' => $input['exam_structure_me'],
            'exam_structure_ha' => $input['exam_structure_ha'],

        ]);
        if ($result) {
            return redirect()->route('exam_structures.index')->with('success', 'C???p nh???t th??nh c??ng');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $delete = ExamStructure::whereExamStructureId($request->examStructureId)->delete();

        if ($delete) {
            return response()->json(['success' => 'X??a th??nh c??ng']);
        } else {
            return response()->json(['error' => 'X??a th???t b???i']);
        }
    }

    public function randomExam(Exam $exam, Request $request)
    {
        $input = $request->except('_token');

        $randomQuestions = Question::with('answers')->inRandomOrder()->limit($input['quantity'])->get();

        return view('exam_structures.show', compact('randomQuestions', 'exam'));
    }

    public function downloadPdf(Exam $exam)
    {
        $randomQuestions = Question::with('answers')->inRandomOrder()->limit(2)->get();

        $pdf = PDF::loadView('exam_structures.show', compact('randomQuestions', 'exam'));
        return $pdf->download('pdfview.pdf');
    }
}
