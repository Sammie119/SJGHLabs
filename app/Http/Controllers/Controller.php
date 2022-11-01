<?php

namespace App\Http\Controllers;

use App\Models\Investigations;
use App\Models\MedicalRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getAliasFromLabRequests(array $lab_requests) 
    {
        $lab_array = [];

        foreach ($lab_requests as $lab_request) {
            $alias = Investigations::select('alias')->where('description', $lab_request)->first()->alias;
            $lab_array[] = $alias;
        }

        return $lab_array;
    }

    protected function getAmountFromLabARequest(array $lab_alias, string $ins_status) 
    {
        $amount_array = [];

        if($ins_status === 'insured'){
            foreach ($lab_alias as $alias) {
                $amount = Investigations::select('insured_amount')->where('description', $alias)->first()->insured_amount;
                $amount_array[] = $amount;
            }
        } else {
            foreach ($lab_alias as $alias) {
                $amount = Investigations::select('noninsured_amount')->where('description', $alias)->first()->noninsured_amount;
                $amount_array[] = $amount;
            }
        }
        
        return $amount_array;
    }

    protected function saveLabReceipt($lab_info_id, $opd_number, $receipt_no, $lab_number)
    {
        $labs = new MedicalRequest;

        $labs->lab_info_id = $lab_info_id;
        $labs->opd_number = $opd_number;
        $labs->ins_status = 'insured';
        $labs->clinical_summary = 'NA';
        $labs->lab_requests = ["No Labs"];
        $labs->lab_alias = ["urinalysis","stool","cooms","hb_profile","pfc","semen","ogtt","psa","h_pylori","dm_profile","anc_urine","lft","rft","lipid","electrolytes","uric","glycated_h","serum","hvs","pleural","peritoneal","csf","bacteriology","g6pd","fbs_rbs","blood_group","urine_hcg","esr","bf_mps","widal","m_rdt","art","fbc","anti_tpha","hbsag","hcv","sickling","covid"];
        $labs->amounts = ["0.00"];
        $labs->total_amount = 0.00;
        $labs->department = "OPD";
        $labs->status = 1;
        $labs->report = 1;
        $labs->receipt_no = $receipt_no;
        $labs->lab_number = $lab_number;        
        $labs->created_by = Session::get('user')['user_id'];
        $labs->updated_by = Session::get('user')['user_id'];

        $labs->save();
    }
}
