<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investigations extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'invest_id';

    protected $guarded = [];

}
