<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VWHaematologyLab;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Report\Attendance;
use App\Http\Controllers\Report\Chemistries;
use App\Http\Controllers\Report\Haematology;
use App\Http\Controllers\Report\Microbiology;

class ReportController extends Controller
{
    public function index()
    {
        return view('report');
    }

    public function getReport(Request $request)
    {
        $report_month = date("m", strtotime($request->report_month));   

        $report_dt = [
            'month' => $request->report_month,
            'year' => $request->report_year
        ];
        
        $year_month = $request->report_year.(integer)$report_month;


        switch ($request->report) {
            case 'haematology':
                $dt = "Haematology";

                $query = Haematology::haema($year_month);
                //return dd($query);

                break;
    
            case 'micro':
                $dt = "Microbiology";

                $query = Microbiology::micro($year_month);

                break;
    
            case 'hiv':
                $dt = "HIV";

                $query = [
                    'sd_bioline_pos' => VWHaematologyLab::whereRaw("CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) = '$year_month'")
                                    ->where('sd_bioline', 'Positive')->get(),
                    'hiv_final_pos' => VWHaematologyLab::whereRaw("CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) = '$year_month'")
                                    ->where('hiv_final', 'Positive')->get(),
                    // 'sd_bioline_neg' => VWHaematologyLab::whereRaw("CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) = '$year_month'")
                    //                 ->where('sd_bioline', 'Negative')->get(),
                    // 'hiv_final_neg' => VWHaematologyLab::whereRaw("CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) = '$year_month'")
                    //                 ->where('hiv_final', 'Negative')->get()
                ];
    
                // dd($query);
                break;
            
            case 'chemistries':
                $dt = "Chemistries";

                $query = Chemistries::chemistries($year_month);

                break;

            case 'attendance':
                $dt = "Attendance";

                $query = Attendance::attendance($year_month);

                // dd($query);

                break;

            default:
                return "No report Selected";
        }

        return view('print-report', compact('year_month', 'dt', 'report_dt', 'query'));
        
    }
}
