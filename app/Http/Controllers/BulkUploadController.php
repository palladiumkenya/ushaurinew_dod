<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Excel;
use Carbon\Carbon;

class BulkUploadController extends Controller
{
    public function uploadClientForm(){
        return view('clients.upload-clients-form');
    }


    public function importClients(Request $request){

        $file = request()->file('file');

        if (!empty($file)) {
            $receivedArr = $this->csvToArray($file);
            for ($i = 0; $i < count($receivedArr); $i++) {
                $gender_value = trim(strtolower($receivedArr[$i]['Gender']));

                if($gender_value == 'm'){
                    $gender = 2;
                }
                elseif ($gender_value=='f') {
                    $gender =1;
                }else {
                    $gender= 5;
                }

                $marital_value = trim(strtolower($receivedArr[$i]['MaritalStatus']));

                if($marital_value == 'divorced'){
                    $marital = 3;
                }elseif ($marital_value == 'living with partner') {
                    $marital = 5;
                }elseif ($marital_value == 'married') {
                    $marital = 2;
                }elseif ($marital_value == 'never married') {
                    $marital = 1;
                }
                elseif ($marital_value == 'polygamous') {
                    $marital = 8;
                }elseif ($marital_value == 'widowed') {
                    $marital = 4;
                }else{
                    $marital = 6;
                }

                $dob_value = trim(strtolower($receivedArr[$i]['DOB']));

                $dob = Carbon::Parse($dob_value)->format('Y-m-d');

                $art_value = trim(strtolower($receivedArr[$i]['ARTStartDate']));

                $art_start_date = Carbon::Parse($art_value)->format('Y-m-d');

                $enrollment_value = trim(strtolower($receivedArr[$i]['enroll_date']));

                $enrollment_date = Carbon::Parse($enrollment_value)->format('Y-m-d');


                $age_value  = (float)$receivedArr[$i]['ageInYears'];
                if($age_value >=20){
                    $group_id = 1;
                }elseif ($age_value >=13) {
                    $group_id = 2;
                }else{
                    $group_id = 4;
                }

                $first_name = trim($receivedArr[$i]['GivenName']);
                $middle_name = trim($receivedArr[$i]['MiddleName']);
                $last_name = trim($receivedArr[$i]['FamilyName']);
                $clinic_number = trim($receivedArr[$i]['CCC_Number']);
                $phone_number = trim($receivedArr[$i]['MobileNumber']);
                $facility_id = trim($receivedArr[$i]['MFL']);
                $mfl_code = trim($receivedArr[$i]['MFL']);
                $partner_id = trim($receivedArr[$i]['PartnerID']);
                $status = "Active";
                $client_status = "Art";
                $clinic_id = 1;
                $text_frequency = 168;
                $text_time = 7;
                $wellness = "Yes";
                $motivational = "Yes";
                $smsenable = "Yes";
                $language = 2;












            //language
            }
        }

    }


    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = [];
        $data = array();

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    // print_r("header not empty");
                    $header = $row;
                } else {
                    // print_r("header empty");
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }

}
