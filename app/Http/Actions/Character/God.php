<?php 
namespace App\Http\Actions\Character;

use App\Http\Actions\Action;
use App\Models\Character;

class God extends Action
{
    public function do($request){
        $character = Character::find( $request->char_id);
      
        $character->exp = 100000;
        $character->life = 1000;
        $character->mana = 1000;
        $character->combat_mastery = 1000;
        $character->sorcery_mastery = 1000;
        $character->movement_mastery = 1000;

        $character->save();

        $this->addData(['character' => $character]);

        return $this->answer;
    }
}