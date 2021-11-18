<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VWBloodTransfussionEpisode extends Model
{
    use HasFactory;

    protected $table = 'v_w_blood_transfussion_episodes';

    public function user() 
    {
        return $this->belongsTo(User::class, 'updated_by');   
    }
}
