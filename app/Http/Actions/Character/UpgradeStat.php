<?php 
namespace App\Http\Actions\Character;

use App\Models\Character;
use App\Http\Actions\Action;

class UpgradeStat extends Action
{
    private static $map = [
        'physical_damage' => ['value' => 15, 'mastery' => 'combat_mastery', 'add_value' => 1],
        'attack_crit_chance' => ['value' => 25, 'mastery' => 'movement_mastery', 'add_value' => 1],
        'life_leech' => ['value' => 40, 'mastery' => 'combat_mastery', 'add_value' => 1],
        'magic_damage' => ['value' => 12, 'mastery' => 'sorcery_mastery', 'add_value' => 1],
        'spell_crit_chance' => ['value' => 20, 'mastery' => 'movement_mastery', 'add_value' => 1],
        'max_life' => ['value' => 25, 'mastery' => 'combat_mastery', 'add_value' => 1],
        'max_mana' => ['value' => 15, 'mastery' => 'sorcery_mastery', 'add_value' => 1],
        'energy' => ['value' => 18, 'mastery' => 'combat_mastery', 'add_value' => 5],
        'energy_regeneration' => ['value' => 12, 'mastery' => 'movement_mastery', 'add_value' => 1],
        'speed' => ['value' => 25, 'mastery' => 'movement_mastery', 'add_value' => 30],
        'armour' => ['value' => 12, 'mastery' => 'combat_mastery', 'add_value' => 1],
        'evade' => ['value' => 12, 'mastery' => 'movement_mastery', 'add_value' => 1],
        'resist' => ['value' => 20, 'mastery' => 'sorcery_mastery', 'add_value' => 1],
        'will' => ['value' => 20, 'mastery' => 'combat_mastery', 'add_value' => 1],
        'attack_block' => ['value' => 30, 'mastery' => 'combat_mastery', 'add_value' => 1],
        'spell_block' => ['value' => 30, 'mastery' => 'sorcery_mastery', 'add_value' => 1],
        'accuracy' => ['value' => 10, 'mastery' => 'movement_mastery', 'add_value' => 2],
    ];

    public function do($request){
        $character = Character::find($request->char_id);
     
        if($character){
            $stat = self::$map[$request->stat];

            if( $character[$stat['mastery']] < $stat['value']){
                $this->setUnsuccess('not enought points');
            }
            else{
                $character[$stat['mastery']] -= $stat['value'];
                $character[$request->stat] += $stat['add_value'];
    
                if($stat['mastery'] === 'combat_mastery'){
                    $character->fight_potential +=  1;
                }
                else if($stat['mastery'] === 'sorcery_mastery'){
                    $character->sorcery_potential +=  1;
                }
                else if($stat['mastery'] === 'movement_mastery'){
                    $character->trick_potential += 1;
                }
    
                $character->save();
                $this->addData(['char' => $character]);
            }
        }

    
        return $this->answer;
    }
}