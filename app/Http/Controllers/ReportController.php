<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VWHaematologyLab;
use Illuminate\Support\Facades\DB;

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


        switch ($request->input('action')) {
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

                $query = VWHaematologyLab::where('hiv_final', 'Positive')->orWhere('sd_bioline', 'Positive')
                        ->where(DB::raw("CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at ))"), "$year_month")->get();
    
                break;
            
            case 'blood':
                $dt = "Chemistries";

                $query = ChemBloodAtt::blood($year_month);

                break;
        }

        return view('print-report', compact('year_month', 'dt', 'report_dt', 'query'));
        
    }
}
