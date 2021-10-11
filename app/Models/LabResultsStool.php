<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsStool extends Model
{
    use HasFactory;

    protected $table = 'lab_results_stools';
    
    protected $primaryKey = 'stool_id';

    protected $guarded = 'stool_id';

    public $timestamps = false;
}
