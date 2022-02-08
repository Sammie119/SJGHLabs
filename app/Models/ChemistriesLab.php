<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChemistriesLab extends Model
{
    use HasFactory;

    protected $table = 'labs_chemistries_episodes';
    
    protected $primaryKey = 'chem_id';

    protected $guarded = 'chem_id';

    public $timestamps = false;
}
