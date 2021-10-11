<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsHpylori extends Model
{
    use HasFactory;

    protected $table = 'lab_results_hpyloris';
    
    protected $primaryKey = 'hpylori_id';

    protected $guarded = 'hpylori_id';

    public $timestamps = false;
}
