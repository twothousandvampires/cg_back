<?php 
namespace App\Http\Actions\Character;

use App\Models\Character;
use App\Models\SkillList;
use App\Models\Skills;
use App\Models\Passives;
use App\Models\PassivesList;
use App\Http\Services\PassiveService;
use Illuminate\Support\Facades\App;
use App\Http\Services\Log;
use App\Http\Actions\Action;

class RestAction extends Action
{

    public $requared_params = [
        'amount'
    ];

    public function do($request) {
        $amount = $request->amount;
        $passiveService = new PassiveService();
        $log = App::make(Log::class);
        $character = Character::find($request->char_id);
       
        $log->addToLog('you rested ' . $amount * 2 . ' life and '. floor($amount / 2). ' mana');
       
        $character->addlife($amount * 2);
        $character->addMana(floor($amount / 2));

        $character->food -= $amount;
        $chance_to_learn = 10 + $amount;
        
        if(mt_rand(0, 100) <= $chance_to_learn){
            $type_rnd = mt_rand(0, 100);
            if($type_rnd <= 50){
                $type_rnd = mt_rand(0, 100);
                if($type_rnd <= 50){
                    $player_skills = Skills::where('char_id',  $character->id)->pluck('skill_name')->toArray();
                    $skill = SkillList::whereNotIn('skill_name', $player_skills)
                        ->where('fp_req', '<=', $character->fight_potential)
                        ->where('sp_req', '<=', $character->sorcery_potential)
                        ->where('tp_req', '<=', $character->trick_potential)
                        ->inRandomOrder()
                        ->first();

                    Skills::create([
                        'char_id' => $character->id,
                        'item_id' => null,
                        'skill_name' => $skill['skill_name'],
                        'skill_type' => $skill['skill_type'],
                        'level' => 1
                    ]);

                    $character[$skill->potential_increase] += $skill->mastery_cost;

                    $log->addToLog('you learned up ' . $skill->skill_name);
                }
                else{
                    $skill = Skills::where('char_id', $character->id)->where('level','!=', 0)->inRandomOrder()->first();
                    if($skill){
                        $skill->level ++;
                        $skill->save();
                    }

                    $character[$skill->potential_increase] += $skill->mastery_cost;
                    
                    $log->addToLog($skill->skill_name . ' increased level');
                }
            }
            else{
                $type_rnd = mt_rand(0, 100);
                if($type_rnd <= 50){
                    $passive = Passives::with('stats')->where('char_id', $character->id)->where('level', '!=', 0)->inRandomOrder()->first();
                    if($passive){
                        $passiveService->upgradePassive($character, $passive);
                        $log->addToLog($passive->name . ' increased level');
                    }
                }
                else{
                    $passives = Passives::where('char_id', $character->id)->pluck('name')->toArray();

                    $passive = PassivesList::inRandomOrder()
                        ->where('fp_req', '<=', $character->fight_potential)
                        ->where('sp_req', '<=', $character->sorcery_potential)
                        ->where('tp_req', '<=', $character->trick_potential)
                        ->where('enable', 1)
                        ->whereNotIn('name', $passives)
                        ->first();

                    if($passive){
                        $passive = Passives::create([
                            'char_id' => $character->id,
                            'name' => $passive->name,
                            'exp_cost' => $passive->exp_cost,
                        ]);
                        $passive->refresh();
                    }
            
                    $passiveService->upgradePassive($character, $passive);
                    $log->addToLog('you learned up ' . $passive->name);
                }
            }
        }
        $character->save();

        $this->addData(['char' => $character, 'log' => $log]);

        return $this->answer;
    }
}