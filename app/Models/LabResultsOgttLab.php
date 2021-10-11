<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsOgttLab extends Model
{
    use HasFactory;

    protected $table = 'lab_results_ogtt_labs';
    
    protected $primaryKey = 'ogtt_id';

    protected $guarded = 'ogtt_id';

    public $timestamps = false;
}
