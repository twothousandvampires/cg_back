<?php 
namespace App\Http\Actions\Skill;

use App\Models\Character;
use App\Models\SkillList;
use App\Models\Skills;
use App\Models\Item;
use App\Http\Actions\Action;
use App\Http\Services\ItemService;

class LearnRandomSkill extends Action
{
    public $requared_params = [
        'used_id'
    ];

    public function do($request){

        $character = Character::find($request->char_id);
        $player_skills = Skills::where('char_id', $character->id)->pluck('skill_name')->toArray();

        $skill = SkillList::whereNotIn('skill_name', $player_skills)
            ->where('fp_req', '<=', $character->fight_potential)
            ->where('sp_req', '<=', $character->sorcery_potential)
            ->where('tp_req', '<=', $character->trick_potential)
            ->inRandomOrder()
            ->first();

        if(!$skill){
            $this->setUnsuccess('no skill');
            return $this->answer;
        }
        Skills::create([
            'char_id' => $character->id,
            'item_id' => null,
            'skill_name' => $skill['skill_name'],
            'skill_type' => $skill['skill_type'],
            'level' => 1
        ]);

        $character[$skill->potential_increase] += $skill->mastery_cost;

        $character->save();
        $used = Item::find($request->used_id);

        $itemService = new ItemService();
        $itemService->useUsed($used);

        $this->addData(['char' => $character]);

        return $this->answer;
    }
}