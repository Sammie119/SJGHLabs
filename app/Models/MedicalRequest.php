<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'req_id';

    protected $guarded = [];

    protected $casts = [
        'lab_requests' => 'array',
        'lab_alias' => 'array',
        'amounts' => 'array'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','updated_by');
    }

    public function patient(){
        return $this->belongsTo('App\Models\VWPatients','opd_number', 'opd_number');
    }
}
