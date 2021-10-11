<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResultsPeriFilm extends Model
{
    use HasFactory;

    protected $table = 'lab_results_peri_films';
    
    protected $primaryKey = 'peri_film_id';

    protected $guarded = 'peri_film_id';

    public $timestamps = false;
}
