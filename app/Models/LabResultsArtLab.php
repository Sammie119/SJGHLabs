<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsArtLab extends Model
{
    use HasFactory;

    protected $table = 'lab_results_art_labs';
    
    protected $primaryKey = 'art_id';

    protected $guarded = 'art_id';

    public $timestamps = false;
}
