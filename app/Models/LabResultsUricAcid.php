<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsUricAcid extends Model
{
    use HasFactory;

    protected $table = 'lab_results_uric_acids';
    
    protected $primaryKey = 'uric_id';
    
    protected $guarded = 'uric_id';

    public $timestamps = false;
}
