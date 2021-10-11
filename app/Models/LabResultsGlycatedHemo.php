<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsGlycatedHemo extends Model
{
    use HasFactory;

    protected $table = 'lab_results_glycated_hemos';
    
    protected $primaryKey = 'glycated_id';

    protected $guarded = 'glycated_id';

    public $timestamps = false;
}
