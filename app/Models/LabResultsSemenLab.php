<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsSemenLab extends Model
{
    use HasFactory;

    protected $table = 'lab_results_semen_labs';
    
    protected $primaryKey = 'semen_id';

    protected $guarded = 'semen_id';

    public $timestamps = false;
}
