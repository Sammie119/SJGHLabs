<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsBacteriology extends Model
{
    use HasFactory;

    protected $table = 'lab_results_bacteriologies';
    
    protected $primaryKey = 'bacter_id';

    protected $guarded = 'bacter_id';

    public $timestamps = false;
}
