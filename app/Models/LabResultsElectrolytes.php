<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsElectrolytes extends Model
{
    use HasFactory;

    protected $table = 'lab_results_electrolytes';
    
    protected $primaryKey = 'electrolytes_id';

    protected $guarded = 'electrolytes_id';

    public $timestamps = false;
}
