<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsHbProfile extends Model
{
    use HasFactory;

    protected $table = 'lab_results_hb_profiles';
    
    protected $primaryKey = 'hb_profile_id';

    protected $guarded = 'hb_profile_id';

    public $timestamps = false;
}
