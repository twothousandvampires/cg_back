<?php 
namespace App\Http\Actions\Character;

use App\Models\Character;
use App\Http\Actions\Action;

class SetAction extends Action
{
    public function do($request){
        $character = Character::find( $request->char_id);
        $character->life = $request->life;
        $character->mana = $request->mana;
        $character->dead = $request->dead;

        $character->combat_mastery += $request->combat_mastery;
        $character->sorcery_mastery += $request->sorcery_mastery;
        $character->movement_mastery += $request->movement_mastery;

        $character->save();

        return $this->answer;
    }
}