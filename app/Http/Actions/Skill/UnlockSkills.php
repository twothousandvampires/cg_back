<?php 
namespace App\Http\Actions\Skill;

use App\Models\Character;
use App\Http\Actions\Action;
use App\Models\SkillList;
use App\Models\Skills;

class UnlockSkills extends Action
{
    public function do($request){

        $character = Character::find($request->char_id);
        $passives = Skills::where('char_id', $character->id)
        ->pluck('skill_name')
        ->toArray();
      
        $new = SkillList::inRandomOrder()
                ->where('fp_req', '<=', $character->fight_potential)
                ->where('sp_req', '<=', $character->sorcery_potential)
                ->where('tp_req', '<=', $character->trick_potential)
                ->whereNotIn('skill_name', $passives)
                ->limit(3)
                ->get();

        foreach ($new as $item){
            Skills::create([
                'char_id' => $request->char_id,
                'skill_name' => $item->skill_name,
                'skill_type' => $item->skill_type,
                'exp_cost' => $item->exp_cost,
                'mastery' => $item->mastery,
                'mastery_cost' => $item->mastery_cost,
                'potential_increase' => $item->potential_increase,
                'level' => 0,
            ]);
        }

        $this->addData(['skills' => Skills::where('char_id', $request->char_id)
                ->where('level', 0)
                ->get()]
                );
       
        return $this->answer;
    }
}