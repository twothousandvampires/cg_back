<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassivesList extends Model
{
    protected $connection = 'game_data';
    protected $table = 'passives_list';
}
