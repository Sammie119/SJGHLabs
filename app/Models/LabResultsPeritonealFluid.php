<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsPeritonealFluid extends Model
{
    use HasFactory;

    protected $table = 'lab_results_peritoneal_fluids';
    
    protected $primaryKey = 'peritoneal_id';

    protected $guarded = 'peritoneal_id';

    public $timestamps = false;
}
