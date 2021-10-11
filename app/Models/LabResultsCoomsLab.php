<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsCoomsLab extends Model
{
    use HasFactory;

    protected $table = 'lab_results_cooms_labs';
    
    protected $primaryKey = 'cooms_id';

    protected $guarded = 'cooms_id';

    public $timestamps = false;
}
