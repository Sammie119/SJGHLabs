<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsFbcLab extends Model
{
    use HasFactory;

    protected $table = 'lab_results_fbc_labs';
    
    protected $primaryKey = 'fbc_id';

    protected $guarded = 'fbc_id';

    public $timestamps = false;
}
