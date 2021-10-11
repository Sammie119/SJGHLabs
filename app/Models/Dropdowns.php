<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dropdowns extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'dropdown_id';

    protected $guarded = 'dropdown_id';

    protected $table = 'dropdowns';

    //protected $with = ['category'];
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
