<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedDetailList extends Model
{

    use HasFactory;
    protected $connection = 'game_data';
    protected $table = 'used_detail_list';

}
