<?php 
namespace App\Http\Actions\Skill;

use App\Models\Character;
use App\Models\Skills;
use App\Http\Actions\Action;

class Skill extends Action

{
    public $requared_params = [
        'skill_id'
    ];

    public function do($request){

        $character = Character::find($request->char_id);

        $skill = Skills::find($request->skill_id);

        if($character->exp < $skill->exp_cost){
            $this->setUnsuccess('no exp');

            return $this->answer;
        }
        if($character[$skill->mastery] < $skill->mastery_cost){
            $this->setUnsuccess('no points');

            return $this->answer;
        }

        $prev_level = $skill->level;

        $skill->level ++;
        $skill->save();
        $character[$skill->mastery] -=  $skill->mastery_cost;
        $character->exp -= $skill->exp_cost;
     
        if($prev_level === 0){
            Skills::where('level', 0)->whereNotNull('char_id')->delete();
            Skills::whereNull('char_id')->where('skill_name', $skill->skill_name)->delete();
        }

        $character[$skill->potential_increase] += $skill->mastery_cost;
        $character->save();
        
        $this->addData(['char' => $character]);

        return $this->answer;
    }
}