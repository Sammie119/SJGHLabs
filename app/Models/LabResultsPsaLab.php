<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsPsaLab extends Model
{
    use HasFactory;

    protected $table = 'lab_results_psa_labs';
    
    protected $primaryKey = 'psa_id';

    protected $guarded = 'psa_id';

    public $timestamps = false;
}
