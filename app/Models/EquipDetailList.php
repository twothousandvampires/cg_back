<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipDetailList extends Model
{
    use HasFactory;

    protected $connection = 'game_data';
    protected $table = 'equip_detail_list';

}
