<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabResultsInfo extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'lab_info_id';

    protected $guarded = 'lab_info_id';

    protected $table = 'lab_results_infos';

    // public function category(){
    //     return $this->belongsTo('App\Models\Category','category_id');
    // }
}
