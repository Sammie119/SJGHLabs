<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodBank extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'blood_banks';

    protected $primaryKey = 'bloodbank_id';

    protected $guarded = 'bloodbank_id';

}
