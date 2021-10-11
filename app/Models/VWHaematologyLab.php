<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VWHaematologyLab extends Model
{
    use HasFactory;

    protected $table = 'v_w_haematology_labs';

    public function user() 
    {
        return $this->belongsTo(User::class, 'updated_by');   
    }

    public function dropdown() 
    {
        return $this->belongsTo(Dropdowns::class, 'department_id');   
    }
}
