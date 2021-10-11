<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsPleuralFluid extends Model
{
    use HasFactory;

    protected $table = 'lab_results_pleural_fluids';
    
    protected $primaryKey = 'pleural_id';

    protected $guarded = 'pleural_id';

    public $timestamps = false;
}
