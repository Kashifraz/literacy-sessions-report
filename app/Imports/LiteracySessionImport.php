<?php

namespace App\Imports;

use App\Models\LiteracySession;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LiteracySessionImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {

        $date = Date::excelToDateTimeObject((int)($row['date']))->format('y-m-d');
        $answers = [
            'question_1' => [
                'strongly_agree' => $row['strongly_agree_1'],
                'agree' => $row['agree_1'],
                'strongly_disagree' => $row['strongly_disagree_1'],
                'disagree' => $row['disagree_1'],
                'no_response' => $row['no_response_1']
            ],
            'question_2' => [
                'strongly_agree' => $row['strongly_agree_2'],
                'agree' => $row['agree_2'],
                'strongly_disagree' => $row['strongly_disagree_2'],
                'disagree' => $row['disagree_2'],
                'no_response' => $row['no_response_2']
            ],
            'question_3' => [
                'strongly_agree' => $row['strongly_agree_3'],
                'agree' => $row['agree_3'],
                'strongly_disagree' => $row['strongly_disagree_3'],
                'disagree' => $row['disagree_3'],
                'no_response' => $row['no_response_3']
            ],
            'question_4' => [
                'strongly_agree' => $row['strongly_agree_4'],
                'agree' => $row['agree_4'],
                'strongly_disagree' => $row['strongly_disagree_4'],
                'disagree' => $row['disagree_4'],
                'no_response' => $row['no_response_4']
            ],
            'question_5' => [
                'strongly_agree' => $row['strongly_agree_5'],
                'agree' => $row['agree_5'],
                'strongly_disagree' => $row['strongly_disagree_5'],
                'disagree' => $row['disagree_5'],
                'no_response' => $row['no_response_5']
            ],
            'question_6' => [
                'strongly_agree' => $row['strongly_agree_6'],
                'agree' => $row['agree_6'],
                'strongly_disagree' => $row['strongly_disagree_6'],
                'disagree' => $row['disagree_6'],
                'no_response' => $row['no_response_6']
            ],
            'question_7' => [
                'strongly_agree' => $row['strongly_agree_7'],
                'agree' => $row['agree_7'],
                'strongly_disagree' => $row['strongly_disagree_7'],
                'disagree' => $row['disagree_7'],
                'no_response' => $row['no_response_7']
            ],
            'question_8' => [
                'strongly_agree' => $row['strongly_agree_8'],
                'agree' => $row['agree_8'],
                'strongly_disagree' => $row['strongly_disagree_8'],
                'disagree' => $row['disagree_8'],
                'no_response' => $row['no_response_8']
            ],
            'question_9' => [
                'strongly_agree' => $row['strongly_agree_9'],
                'agree' => $row['agree_9'],
                'strongly_disagree' => $row['strongly_disagree_9'],
                'disagree' => $row['disagree_9'],
                'no_response' => $row['no_response_9']
            ],
            'question_10' => [
                'strongly_agree' => $row['strongly_agree_10'],
                'agree' => $row['agree_10'],
                'strongly_disagree' => $row['strongly_disagree_10'],
                'disagree' => $row['disagree_10'],
                'no_response' => $row['no_response_10']
            ],
            'question_11' => [
                'strongly_agree' => $row['strongly_agree_11'],
                'agree' => $row['agree_11'],
                'strongly_disagree' => $row['strongly_disagree_11'],
                'disagree' => $row['disagree_11'],
                'no_response' => $row['no_response_11']
            ],
            'question_12' => [
                'strongly_agree' => $row['strongly_agree_12'],
                'agree' => $row['agree_12'],
                'strongly_disagree' => $row['strongly_disagree_12'],
                'disagree' => $row['disagree_12'],
                'no_response' => $row['no_response_12']
            ],
        ];
        $whereData = [
            
        ];

        $dataExist = LiteracySession::where([
            ['conductedby', $row['conductedby']],
            ['topic' ,$row['topic']],
            ['department' , $row['department']],
            ['program' , $row['programs']],
            ['sessiondate','=',  $date],
            ['email' , $row["email_address"]]
        ])->first();
            

        if ($dataExist) {
            return;
        } else {
            return new LiteracySession([
                'email'    => $row["email_address"],
                'attendees' => 0,
                'identity' => $row['who_are_you'],
                'sessiondate'    => $date,
                'campus'    => $row['campus'],
                'topic'    => $row['topic'],
                'department'    => $row['department'],
                'participants' => $row['participants'],
                'conductedby' => $row['conductedby'],
                "program" => $row['programs'],
                // "images" => json_encode($row['session_images']),
                "images" => "xyz",
                "answers" => json_encode($answers),
            ]);
        }
    }

    public function headingRow()
    {
        return 1;
    }
}
