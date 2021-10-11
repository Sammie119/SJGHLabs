<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsCerebroFluid extends Model
{
    use HasFactory;

    protected $table = 'lab_results_cerebro_fluids';
    
    protected $primaryKey = 'cerebro_id';

    protected $guarded = 'cerebro_id';

    public $timestamps = false;
}
