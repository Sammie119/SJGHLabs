<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsUrinalysis extends Model
{
    use HasFactory;

    protected $table = 'lab_results_urinalyses';
    
    protected $primaryKey = 'urinal_id';

    protected $guarded = 'urinal_id';

    public $timestamps = false;
}
