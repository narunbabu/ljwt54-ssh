<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['dist_code','sub_dist_code', 'sub_dist_name'];
}