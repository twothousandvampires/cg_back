<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    protected $table = 'skills';
    public $timestamps = false;
    protected $fillable = ['char_id', 'item_id', 'skill_name', 'level', 'skill_type', 'exp_cost', 'mastery', 'mastery_cost', 'potential_increase'];
}
