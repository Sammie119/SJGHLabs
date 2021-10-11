<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsLipidProfile extends Model
{
    use HasFactory;

    protected $table = 'lab_results_lipid_profiles';
    
    protected $primaryKey = 'lipid_id';

    protected $guarded = 'lipid_id';

    public $timestamps = false;
}
