<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HaematologyLab extends Model
{
    use HasFactory;

    protected $table = 'labs_haematology_episodes';
    
    protected $primaryKey = 'haema_id';

    protected $guarded = 'haema_id';

    public $timestamps = false;
}
