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
        DB::table('game_data.passives_list')->insert([
            'name' => 'versality combatant',
            'exp_cost' => 250,
            'fp_req' => 10,
            'sp_req' => 10,
            'tp_req' => 0,
            'enable' => 1
        ]);
        
        DB::table('game_data.passives_list')->insert([
            'name' => 'concentration',
            'exp_cost' => 250,
            'fp_req' => 5,
            'sp_req' => 0,
            'tp_req' => 10,
            'enable' => 1,
            'potential_increase' => 'trick_potential'
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
