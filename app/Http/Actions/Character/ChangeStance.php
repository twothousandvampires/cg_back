<?php 
namespace App\Http\Actions\Character;

use App\Http\Actions\Action;
use App\Models\Character;
class ChangeStance extends Action
{
    public function do($request){
        $character = Character::find( $request->char_id);
      
        if($character->stance === 'combat'){
            $character->stance = 'sorcery';
            // $character->physical_damage -= $character->combat_stance_value;
            // $character->magic_damage += $character->sorcery_stance_value;
        }
        else if($character->stance === 'sorcery'){
            $character->stance = 'combat';
            // $character->physical_damage += $character->combat_stance_value;
            // $character->magic_damage -= $character->sorcery_stance_value;
        }

        $character->save();

        $this->addData(['character' => $character]);
        return $this->answer;
    }
}