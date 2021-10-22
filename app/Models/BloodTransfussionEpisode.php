<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodTransfussionEpisode extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'bloodtrans_id';

    protected $guarded = 'bloodtrans_id';

    protected $table = 'blood_transfussion_episodes';
}
