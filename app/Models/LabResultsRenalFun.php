<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsRenalFun extends Model
{
    use HasFactory;

    protected $table = 'lab_results_renal_funs';
    
    protected $primaryKey = 'renal_id';

    protected $guarded = 'renal_id';

    public $timestamps = false;
}
