<?php

namespace App\Http\Controllers;

use App\Models\Investigations;
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
}
