<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsHighVaginal extends Model
{
    use HasFactory;

    protected $table = 'lab_results_high_vaginals';
    
    protected $primaryKey = 'vaginal_id';

    protected $guarded = 'vaginal_id';

    public $timestamps = false;
}
