<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VWBloodBankLabs extends Model
{
    use HasFactory;

    protected $table = 'v_w_blood_bank_labs';

    public function user() 
    {
        return $this->belongsTo(User::class, 'updated_by');   
    }
}
