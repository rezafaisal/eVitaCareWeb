<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\DmGender;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\HomeCarePatient;
use App\Models\DmMonitoringStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeCarePatientController extends Controller
{
    public function index(){
        $genders = DmGender::orderBy('gender')->get();
        $statuses = DmMonitoringStatus::orderBy('status')->get();
        $dpjp = User::wherehas('user_role', function($q){
            $q->where('dm_role_id', 2);
        })->orderBy('name')->get();
        return view('home_care_patient.index', compact('dpjp', 'genders', 'statuses'));
    }

    public function changeStatus($id, $statusId){
        try{
            $homeCare = HomeCarePatient::findOrFail($id);
            $homeCare->dm_monitoring_status_id = $statusId;

            if($statusId == 2){
                $homeCare->monitoring_start_date = now();
            }else if($statusId == 3){
                $homeCare->monitoring_end_date = now();
            }

            $homeCare->save();
            return [
                'status' => 'success',
                'title' => 'Sukses',
                'message' => 'Berhasil mengubah status'
            ];
        }catch(Exception $e){
            return [
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Terjadi kesalahan, silahkan coba lagi!'
            ];
        }
    }

    public function changeDpjp($id, $dpjpId){
        try{
            $homeCare = HomeCarePatient::findOrFail($id);
            $homeCare->doctor_dpjp_id = $dpjpId;
            $homeCare->save();
            return [
                'status' => 'success',
                'title' => 'Sukses',
                'message' => 'Berhasil mengubah DPJP'
            ];
        }catch(Exception $e){
            return [
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Terjadi kesalahan, silahkan coba Lagi!'
            ];
        }
    }

    public function detail($id){
        $home_care_patient = HomeCarePatient::with('vital_sign')->findOrFail($id);
        return view('home_care_patient.detail', compact('home_care_patient'));
    }

    public function datatable(Request $request){
        /* ================== [1] Persiapan Pengambilan Data ================== */
        $startNumber = $request->start;
        $rowperpage = $request->length;
        $records = HomeCarePatient::with('patient', 'dm_monitoring_status')
                                    ->join('patients', 'patients.id', '=', 'home_care_patients.patient_id');

        /* ================== [2] Sorting Kolom ================== */
        $sortColumnIndex = $request->order[0]['column'];
        $sortColumnName = $request->columns[$sortColumnIndex]['data'];
        $sortType = $request->order[0]['dir'];
        if($sortColumnName === "no"){
            $records = $records->orderBy('registration_date', 'DESC');
        }else{
            if($sortColumnName == "name"){
                $records = $records->orderBy('patients.name', $sortType);
            }else if($sortColumnName == "gender"){
                $records = $records->join('dm_genders', 'dm_genders.id', '=', 'patients.dm_gender_id');
                $records = $records->orderBy('dm_genders.gender', $sortType);
            }else if($sortColumnName == "age"){
                $records = $records->orderBy('patients.birth_date', $sortType);
            }else if($sortColumnName == "registration_date"){
                $records = $records->orderBy('registration_date', $sortType);
            }else if($sortColumnName == "begin_date"){
                $records = $records->orderBy('monitoring_start_date', $sortType);
            }else if($sortColumnName == "final_date"){
                $records = $records->orderBy('monitoring_end_date', $sortType);
            }else if($sortColumnName == "status"){
                $records = $records->join('dm_monitoring_statuses', 'dm_monitoring_statuses.id', '=', 'home_care_patients.dm_monitoring_status_id');
                $records = $records->orderBy('dm_monitoring_statuses.status', $sortType);
            }else if($sortColumnName == "dpjp"){
                $records = $records->join('users', 'users.id', '=', 'home_care_patients.doctor_dpjp_id');
                $records = $records->orderBy('users.name', $sortType);
            }
            
        }

        /* ================== [3] Individual Search ================== */
        $nameSearch = $request->columns[1]['search']['value'];
        if($nameSearch){
            $records = $records->wherehas('patient', function($q) use ($nameSearch){
                $q->where('name', 'like', "%{$nameSearch}%");
            });
        }

        $genderSearch = $request->columns[2]['search']['value'];
        if($genderSearch && $genderSearch != "SEMUA"){
            $records = $records->wherehas('patient', function($q) use ($genderSearch){
                $q->where('dm_gender_id', $genderSearch);
            });
        }

        $ageSearch = $request->columns[3]['search']['value'];
        if($ageSearch){
            $records = $records->where(DB::raw("CAST(TIMESTAMPDIFF(YEAR, patients.birth_date, CURDATE()) AS CHAR(10))"), 'like', "%{$ageSearch}%");
        }

        $registrationDateSearch = $request->columns[4]['search']['value'];
        if($registrationDateSearch){
            $dates = explode("-", $registrationDateSearch);
            $records = $records->whereYear('registration_date', $dates[0]);
            $records = $records->whereMonth('registration_date', $dates[1]);
        }

        $beginDateSearch = $request->columns[5]['search']['value'];
        if($beginDateSearch){
            $dates = explode("-", $beginDateSearch);
            $records = $records->whereYear('monitoring_start_date', $dates[0]);
            $records = $records->whereMonth('monitoring_start_date', $dates[1]);
        }

        $finalDateSearch = $request->columns[6]['search']['value'];
        if($finalDateSearch){
            $dates = explode("-", $finalDateSearch);
            $records = $records->whereYear('monitoring_end_date', $dates[0]);
            $records = $records->whereMonth('monitoring_end_date', $dates[1]);
        }

        $statusSearch = $request->columns[7]['search']['value'];
        if($statusSearch && $statusSearch !== "SEMUA"){
            $records = $records->where('dm_monitoring_status_id', $statusSearch);
        }

        $dpjpSearch = $request->columns[8]['search']['value'];
        if($dpjpSearch){
            $records = $records->wherehas('doctor_dpjp', function($q) use ($dpjpSearch){
                $q->where('name', 'like', "%{$dpjpSearch}%");
            });
        }

        /* ================== [4] Pengambilan Data ================== */
        $totalRecordswithFilter = $records->count();
        $totalRecord = HomeCarePatient::count();
        $records = $records->skip($startNumber)->take($rowperpage)->get();

        /* ================== [5] Memformat Data ================== */
        $data_arr = array();
        foreach($records as $index => $record){
            $data_arr[] = array(
                "id" => $record->id,
                "no" => $startNumber + $index + 1,
                "name" => $record->patient->name,
                "gender" => $record->patient->dm_gender->gender,
                "age" => $record->patient->age,
                "registration_date" => explode(" ", $record->registration_date ?? "- ")[0],
                "begin_date" => explode(" ", $record->monitoring_start_date ?? "- ")[0],
                "final_date" => explode(" ", $record->monitoring_end_date ?? "- ")[0],
                'status' => $record->dm_monitoring_status->status,
                "status_id" => $record->dm_monitoring_status_id,
                'dpjp' => $record->doctor_dpjp->name,
                'dpjp_id' => $record->doctor_dpjp->id,
            );
        }

        /* ================== [6] Mengirim JSON ================== */
        echo json_encode([
            "draw" => intval($request->draw),
            "iTotalRecords" => $totalRecord,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ]);
    }

    public function getChat($id){
        $raw_consultations = Consultation::whereHas('home_care_patient', function($q) use ($id){
            $q->where('patient_id', $id);
        })->orderBy('created_at', 'ASC')->get();     
                                    
        $consultations = [];
        foreach($raw_consultations as $consultation){
            $responded_id = $consultation->user_responded_id;
            $consultations[] = [
                'text' => $consultation->message,
                'picture' => asset($responded_id ? $responded_id == Auth::user()->id ? 'assets/img/avatar/avatar-1.png' :  'assets/img/avatar/avatar-3.png' : 'assets/img/avatar/avatar-2.png'),
                'position' => $responded_id == Auth::user()->id ? 'chat-right' : 'chat-left',
            ];
        }

        return response([
            'chats' => $consultations
        ]);
    }

    public function sendChat(Request $request, $id){
        try{
            Consultation::create([
                'home_care_patient_id' => $id,
                'user_responded_id' => Auth::user()->id,
                'message' => $request->message
            ]);

            return response([
                'success' => true,
                'message' => 'Kirim pesan berhasil!'
            ]);
        }catch(Exception $e){
            return response([
                'success' => false,
                'message' => 'Terjadi Kesalahan, SIlahkan Coba Lagi!'
            ]);
        }
    }
}
