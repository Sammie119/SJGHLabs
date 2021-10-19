<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodDonor extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    protected $primaryKey = 'donor_id';

    protected $guarded = 'donor_id';

    protected $table = 'blood_donors';
}
