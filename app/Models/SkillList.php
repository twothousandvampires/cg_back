<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillList extends Model
{
    protected $connection = 'game_data';
    protected $table = 'skill_list';
    public $timestamps = false;
}
