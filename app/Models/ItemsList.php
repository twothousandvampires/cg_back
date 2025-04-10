<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsList extends Model
{
    protected $connection = 'game_data';
    protected $table = 'item_list';
    use HasFactory;
    private static array $GEMS_LIST = [
        'learning stone',
        'improving stone',
        'unpredictable stone'
    ];

    static function getRandomGemName($rarity){
        $item = ItemsList::leftJoin('game_data.used_detail_list as udl', 'udl.item_list_id', '=' , 'item_list.id')
            ->where('udl.used_type', 3)
            ->where('rarity','<=', $rarity)
            ->where('type', 3)
            ->inRandomOrder()
            ->first();

        return $item ? $item->name : null;
    }
}

