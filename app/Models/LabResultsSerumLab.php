<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsSerumLab extends Model
{
    use HasFactory;

    protected $table = 'lab_results_serum_labs';
    
    protected $primaryKey = 'serum_id';

    protected $guarded = 'serum_id';

    public $timestamps = false;
}
