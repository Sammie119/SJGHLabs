<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsLiverFun extends Model
{
    use HasFactory;

    protected $table = 'lab_results_liver_funs';
    
    protected $primaryKey = 'liver_id';

    protected $guarded = 'liver_id';

    public $timestamps = false;
}
