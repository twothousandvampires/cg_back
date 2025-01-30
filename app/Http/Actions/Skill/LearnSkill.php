<?php 
namespace App\Http\Actions\Skill;

use App\Models\Character;
use App\Models\Skills;
use App\Models\Item;
use App\Http\Actions\Action;
use App\Http\Services\ItemService;

class LearnSkill extends Action

{
    public $requared_params = [
        'used_id',
        'skill_id'
    ];

    public function do($request){

        $character = Character::find($request->char_id);

        $skill = Skills::find($request->skill_id);
        
        $skill->level = 1;
        $skill->char_id = $character->id;
        
        $character[$skill->potential_increase] += $skill->mastery_cost;

        $character->save();
        $used = Item::find($request->used_id);

    
        Skills::where('item_id', $skill->item_id)->where('id','!=', $skill->id)->delete();

        Skills::whereNotNull('char_id')->where('skill_name', $skill->skill_name)->delete();

        $skill->item_id = null;
        $skill->save();

        $itemService = new ItemService();
        $itemService->useUsed($used);

        $character->refresh();

        $this->addData(['char' => $character]);

        return $this->answer;
    }
}