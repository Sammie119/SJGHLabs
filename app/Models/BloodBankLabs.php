<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodBankLabs extends Model
{
    use HasFactory;

    protected $primaryKey = 'blood_labs_id';

    protected $guarded = 'blood_labs_id';

    protected $table = 'blood_bank_labs';

    public $timestamps = false;
}
