<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Department;
use App\Models\LiteracySession;
use App\Models\Program;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Imports\LiteracySessionImport;
use Illuminate\Support\Facades\File;
use Excel;
use DocxMerge\DocxMerge;
use Illuminate\Support\Facades\Storage;
use Mockery\Undefined;
use PhpOffice\PhpWord\Shared\Converter;

class LiteracySessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $sessions = LiteracySession::distinct()->orderBy('sessiondate', 'DESC')->paginate(15);
        return view("literacysession.reports", ["sessions" => $sessions]);
    }

    public function create()
    {
        $campuses = Campus::all();
        $departments = Department::all();
        $programs = Program::all();
        $topics = Topic::all();
        return view('literacysession.create', [
            "campuses" => $campuses,
            "departments" => $departments,
            "programs" => $programs,
            "topics" => $topics
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $images = [];
        if ($request->images) {
            foreach ($request->images as $key => $image) {
                $imageName = time() . rand(1, 99) . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);
                $images[] = $imageName;
            }
        }

        $validated = $request->validate([
            "email" => "required",
            "attendees" => "required",
            "participants" => "required",
            "identity" => "required",
            "topic" => "required|not_in:0",
            "department" => "required|not_in:0",
            "program" => "required|not_in:0",
            "campus" => "required|not_in:0",
            "conductedby" => "required",
            // "images" => "required",
            // "answers" => "required",
            "sessiondate" => "required",
        ]);

        $answers = [
            'question_1' => [
                'strongly_agree' => $request->strongly_agree['0'],
                'agree' => $request->agree['0'],
                'strongly_disagree' => $request->strongly_disagree['0'],
                'disagree' => $request->disagree['0'],
                'no_response' => $request->no_response['0']
            ],
            'question_2' => [
                'strongly_agree' => $request->strongly_agree['1'],
                'agree' => $request->agree['1'],
                'strongly_disagree' => $request->strongly_disagree['1'],
                'disagree' => $request->disagree['1'],
                'no_response' => $request->no_response['1']
            ],
            'question_3' => [
                'strongly_agree' => $request->strongly_agree['2'],
                'agree' => $request->agree['2'],
                'strongly_disagree' => $request->strongly_disagree['2'],
                'disagree' => $request->disagree['2'],
                'no_response' => $request->no_response['2']
            ],
            'question_4' => [
                'strongly_agree' => $request->strongly_agree['3'],
                'agree' => $request->agree['3'],
                'strongly_disagree' => $request->strongly_disagree['3'],
                'disagree' => $request->disagree['3'],
                'no_response' => $request->no_response['3']
            ],
            'question_5' => [
                'strongly_agree' => $request->strongly_agree['4'],
                'agree' => $request->agree['4'],
                'strongly_disagree' => $request->strongly_disagree['4'],
                'disagree' => $request->disagree['4'],
                'no_response' => $request->no_response['4']
            ],
            'question_6' => [
                'strongly_agree' => $request->strongly_agree['5'],
                'agree' => $request->agree['5'],
                'strongly_disagree' => $request->strongly_disagree['5'],
                'disagree' => $request->disagree['5'],
                'no_response' => $request->no_response['5']
            ],
            'question_7' => [
                'strongly_agree' => $request->strongly_agree['6'],
                'agree' => $request->agree['6'],
                'strongly_disagree' => $request->strongly_disagree['6'],
                'disagree' => $request->disagree['6'],
                'no_response' => $request->no_response['6']
            ],
            'question_8' => [
                'strongly_agree' => $request->strongly_agree['7'],
                'agree' => $request->agree['7'],
                'strongly_disagree' => $request->strongly_disagree['7'],
                'disagree' => $request->disagree['7'],
                'no_response' => $request->no_response['7']
            ],
            'question_9' => [
                'strongly_agree' => $request->strongly_agree['8'],
                'agree' => $request->agree['8'],
                'strongly_disagree' => $request->strongly_disagree['8'],
                'disagree' => $request->disagree['8'],
                'no_response' => $request->no_response['8']
            ],
            'question_10' => [
                'strongly_agree' => $request->strongly_agree['9'],
                'agree' => $request->agree['9'],
                'strongly_disagree' => $request->strongly_disagree['9'],
                'disagree' => $request->disagree['9'],
                'no_response' => $request->no_response['9']
            ],
            'question_11' => [
                'strongly_agree' => $request->strongly_agree['10'],
                'agree' => $request->agree['10'],
                'strongly_disagree' => $request->strongly_disagree['10'],
                'disagree' => $request->disagree['10'],
                'no_response' => $request->no_response['10']
            ],
            'question_12' => [
                'strongly_agree' => $request->strongly_agree['11'],
                'agree' => $request->agree['11'],
                'strongly_disagree' => $request->strongly_disagree['11'],
                'disagree' => $request->disagree['11'],
                'no_response' => $request->no_response['11']
            ],
        ];


        $literacySession = LiteracySession::create([
            "email" => $request->email,
            "attendees" => $request->attendees,
            "participants" => $request->participants,
            "identity" => $request->identity,
            "topic" => $request->topic,
            "department" => $request->department,
            "program" => $request->program,
            "campus" => $request->campus,
            "conductedby" => $request->conductedby,
            "images" => json_encode($images),
            "answers" => json_encode($answers),
            "sessiondate" => $request->sessiondate,
        ]);


        return redirect()->back()->with("message", "Literacy Session Form submitted successfully!");
    }

    public function import()
    {

        return view('literacysession.import');
    }

    public function importData(Request $request)
    {

        $validated = $request->validate([
            "file" => "required|mimes:xlsx",
        ]);

        Excel::import(new LiteracySessionImport, $request->file("file"));
        return redirect()->back()->with("message", "Data imported successfully");
    }

    public function generateWord($id)
    {
        $literacySession = LiteracySession::find($id);
        $answers = json_decode($literacySession->answers);
        //Question to use as chart categories
        $categories = array(
            'Venue Comfortable', 'Venue Well Located', 'Contents Relevant', 'Contents Comprehensive', 'Contents Easy to Understand', 'Session Well Placed', 'Session Good Mix', 'Session Duration Sufficient', 'Useful Learning Experience', 'Facilitator Knowledgeable', 'Facilitator Well Prepared', 'Facilitator Responsive'
        );

        //creating data arrays for for column series 
        $strongly_agree_series = array();
        $agree_series = array();
        $strongly_disagree_series = array();
        $disagree_series = array();
        $no_response_series = array();
        //avg response array
        $avg_responses = array();

        foreach ($answers as $answer) {
            array_push($strongly_agree_series, $answer->strongly_agree == null ? 0 : $answer->strongly_agree);
            array_push($agree_series, $answer->agree == null ? 0 : $answer->agree);
            array_push($strongly_disagree_series, $answer->strongly_disagree == null ? 0 : $answer->strongly_disagree);
            array_push($disagree_series, $answer->disagree == null ? 0 : $answer->disagree);
            array_push($no_response_series, $answer->no_response == null ? 0 : $answer->no_response);
        }
        //create data array for avg responses chart
        for ($i = 0; $i < 12; $i++) {
            $avg_data = ((((is_int($strongly_agree_series[$i]) ? round(($strongly_agree_series[$i]), 2) : 0) * 4))+
                ((is_int($agree_series[$i]) ? round(($agree_series[$i]), 2) : 0)* 3)) +
                (((is_int($disagree_series[$i]) ? round(($disagree_series[$i]), 2) : 0)* 2)) +
                (((is_int($strongly_disagree_series[$i]) ? round(($strongly_disagree_series[$i]), 2) : 0) * 1)) +
                (((is_int($no_response_series[$i]) ? round(($no_response_series[$i]), 2) : 0) * 0)) /
                (is_int($literacySession->participants) ? ($literacySession->participants) : 60);

            array_push($avg_responses, $avg_data);
        }

        return view('literacysession.word', [
            "literacySession" => $literacySession,
            "categories" => json_encode($categories),
            "strongly_agree_series" => json_encode($strongly_agree_series),
            "agree_series" => json_encode($agree_series),
            "strongly_disagree_series" => json_encode($strongly_disagree_series),
            "disagree_series" => json_encode($disagree_series),
            "no_response_series" => json_encode($no_response_series),
            "avg_responses" => json_encode($avg_responses),
        ]);
    }

    public function downloadReport(Request $request)
    {

        $session_id = $request->session_id;
        $image = $request->input('session_chart_base64'); // image base64 encoded
        $image_extension = null;
        preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
        $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
        $image = str_replace(' ', '+', $image);
        if ($image_extension[1] != null) {
            $imageName = 'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
        } else {
            return "there is something wrong";
        }
        $file = base64_decode($image);
        $success = file_put_contents(public_path() . '/charts/' . $imageName, $file);
        $literacySession = LiteracySession::find($session_id);
        $answers = json_decode($literacySession->answers);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $templatePath = public_path("templates/RIU1.docx");
        $reportsPath = public_path("reports/ILS-report-template.docx");
        // loading word template
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
        //setting template varaibles and temporarily saving file
        $templateProcessor->setValue('Date', htmlspecialchars($literacySession->sessiondate, ENT_COMPAT, 'UTF-8'));
        $templateProcessor->setValue('Campus', htmlspecialchars($literacySession->campus, ENT_COMPAT, 'UTF-8'));
        $templateProcessor->setValue('Topic', htmlspecialchars($literacySession->topic, ENT_COMPAT, 'UTF-8'));
        $templateProcessor->setValue('Faculty / Department', htmlspecialchars($literacySession->department, ENT_COMPAT, 'UTF-8'));
        $templateProcessor->setValue('Programs', htmlspecialchars($literacySession->program, ENT_COMPAT, 'UTF-8'));
        $templateProcessor->setValue('Conducted By', htmlspecialchars($literacySession->conductedby, ENT_COMPAT, 'UTF-8'));
        $templateProcessor->setValue('Participants', htmlspecialchars($literacySession->participants, ENT_COMPAT, 'UTF-8'));
        $templateProcessor->setValue('Session Attendees', htmlspecialchars($literacySession->attendees, ENT_COMPAT, 'UTF-8'));
        $templateProcessor->saveAs($reportsPath);

        //Question to use as chart categories
        $categories = array(
            'Venue Comfortable', 'Venue Well Located', 'Contents Relevant', 'Contents Comprehensive', 'Contents Easy to Understand', 'Session Well Placed', 'Session Good Mix', 'Session Duration Sufficient', 'Useful Learning Experience', 'Facilitator Knowledgeable', 'Facilitator Well Prepared', 'Facilitator Responsive'
        );


        //creating data arrays for for column series 
        $strongly_agree_series = array();
        $agree_series = array();
        $strongly_disagree_series = array();
        $disagree_series = array();
        $no_response_series = array();
        //avg response array
        $avg_responses = array();

        foreach ($answers as $answer) {
            array_push($strongly_agree_series, $answer->strongly_agree == null ? 0 : $answer->strongly_agree);
            array_push($agree_series, $answer->agree == null ? 0 : $answer->agree);
            array_push($strongly_disagree_series, $answer->strongly_disagree == null ? 0 : $answer->strongly_disagree);
            array_push($disagree_series, $answer->disagree == null ? 0 : $answer->disagree);
            array_push($no_response_series, $answer->no_response == null ? 0 : $answer->no_response);
        }
        //create data array for avg responses chart
        for ($i = 0; $i < 12; $i++) {
            $avg_data = (((is_int($strongly_agree_series[$i]) ? round(($strongly_agree_series[$i]), 2) : 0)) +
                (is_int($agree_series[$i]) ? round(($agree_series[$i]), 2) : 0)) +
                ((is_int($disagree_series[$i]) ? round(($disagree_series[$i]), 2) : 0)) +
                ((is_int($strongly_disagree_series[$i]) ? round(($strongly_disagree_series[$i]), 2) : 0)) +
                ((is_int($no_response_series[$i]) ? round(($no_response_series[$i]), 2) : 0)) /
                (is_int($literacySession->participants) ? ($literacySession->participants) : 60);

            array_push($avg_responses, $avg_data);
        }

        //styles and options of chart
        $style = array(
            'width'          => Converter::cmToEmu(16),
            'height'         => Converter::cmToEmu(12),
            '3d'             => false,
            'valueAxisTitle' => 'No of Participants',
            'showAxisLabels' => true,
            'showGridX'      => false,
            'showGridY'      => true,
            'categoryAxisTitle' => 'Questions',
        );

        $section = $phpWord->addSection(array('colsNum' => 1));
        $chart_responses = $section->addChart('column', $categories, $avg_responses, $style);
        $chart_responses->getStyle()->setDataLabelOptions([
            'showVal'          => false,
            'showCatName'      => false,
        ]);
        $section->addTextBreak();

        //creating participants response chart
        $phpWord->addTitleStyle(1, array('size' => 14, 'bold' => true), array('keepNext' => true, 'spaceBefore' => 240));
        $phpWord->addTitleStyle(2, array('size' => 14, 'bold' => true), array('keepNext' => true, 'spaceBefore' => 240));
        $section = $phpWord->addSection();
        $section->addTitle("Participants Responses in Numbers (Question Wise)");
        $section->addTextBreak();
        $section->addTextBreak();
        $section->addImage(
            public_path() . '/charts/' . $imageName,
            array(
                'width'         => 450,
                'height'        => 280,
                'marginTop'     => -1,
                'marginLeft'    => 0,
                'wrappingStyle' => 'behind'
            )
        );

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'reports/ILS_report_temp.docx';
        try {
            $objWriter->save(public_path($fileName));
        } catch (Exception $e) {
        }

        $dm = new DocxMerge();
        $dm->merge([
            "reports/ILS-report-template.docx",
            "reports/ILS_report_temp.docx"
        ], "reports/ILS_report.docx");

        File::delete(public_path('reports/ILS-report-template.docx'), public_path('reports\ILS_report_temp.docx'));
        return response()->download(public_path('reports/ILS_report.docx'));
    }
}
