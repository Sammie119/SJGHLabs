<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsGeneralLab extends Model
{
    use HasFactory;

    protected $table = 'lab_results_general_labs';
    
    protected $primaryKey = 'general_id';

    protected $guarded = 'general_id';

    public $timestamps = false;
}
