<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('passive_stats')->insert([
            'passive_name' => 'versality combatant',
            'stat' => 'chance_not_lose_ap_when_change_stance',
            'add_per_level' => 5,
            'description' => 'gives a chance to not lose action point when you change a stance',
            'start_value' => 10,
        ]);

        DB::table('passive_stats')->insert([
            'passive_name' => 'versality combatant',
            'stat' => 'combat_stance_value',
            'add_per_level' => 1,
            'description' => 'gives you additional physical damage then combat stance',
            'start_value' => 1,
        ]);

        DB::table('passive_stats')->insert([
            'passive_name' => 'versality combatant',
            'stat' => 'sorcery_stance_value',
            'add_per_level' => 1,
            'description' => 'gives you magic damage then sorcery stance',
            'start_value' => 1,
        ]);

        DB::table('passive_stats')->insert([
            'passive_name' => 'concentration',
            'stat' => 'chance_not_lose_cp_when_max',
            'add_per_level' => 5,
            'description' => 'gives you a chance not to lose combo point then you reached max',
            'start_value' => 10,
        ]);

        DB::table('passive_stats')->insert([
            'passive_name' => 'concentration',
            'stat' => 'chance_not_lose_cp_when_turn_end',
            'add_per_level' => 5,
            'description' => 'gives you a chance save 1 combo point then turn end',
            'start_value' => 10,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
