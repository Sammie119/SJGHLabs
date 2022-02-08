<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroBiologyLab extends Model
{
    use HasFactory;

    protected $table = 'labs_micro_biology_episodes';
    
    protected $primaryKey = 'micro_id';

    protected $guarded = 'micro_id';

    public $timestamps = false;
}
