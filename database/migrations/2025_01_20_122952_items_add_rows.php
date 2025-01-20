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
        DB::table('game_data.item_list')->insert([
           [
            'name' => 'weightless chainmail',
            'type' => 1,
            'rarity' => 2
           ],
           [
            'name' => 'additional plates',
            'type' => 1,
            'rarity' => 2
           ],
        ]);

        $id =  DB::table('game_data.item_list')->where('name', 'weightless chainmail')->first()->id;

        DB::table('game_data.equip_detail_list')->insert([
            [
             'equip_type' => 2,
             'equip_class' => 2,
             'item_list_id' => $id
            ],
         ]);

         DB::table('equipment_properties_list')->insert([
            [
             'item_name' => 'weightless chainmail',
             'type' => 'sorcery',
             'class' => 'armour',
             'low' => 1,
             'normal' => 2,
             'good' => 3,
             'masterpiece' => 6,
             'stat' => 'armour',
             'name' => 'adds armour',
             'sub_type' => 1,
             'requared_slot' => null
            ],
         ]);

         DB::table('equipment_properties_list')->insert([
            [
             'item_name' => 'weightless chainmail',
             'type' => 'sorcery',
             'class' => 'armour',
             'low' => 1,
             'normal' => 2,
             'good' => 3,
             'masterpiece' => 6,
             'stat' => 'magic_damage',
             'name' => 'adds magic damage',
             'sub_type' => 1,
             'requared_slot' => null
            ],
         ]);

         $id = DB::table('game_data.item_list')->where('name', 'additional plates')->first()->id;

         DB::table('game_data.equip_detail_list')->insert([
            [
             'equip_type' => 2,
             'equip_class' => 1,
             'item_list_id' => $id
            ],
         ]);

         DB::table('equipment_properties_list')->insert([
            [
             'item_name' => 'additional plates',
             'type' => 'combat',
             'class' => 'armour',
             'low' => 1,
             'normal' => 2,
             'good' => 3,
             'masterpiece' => 6,
             'stat' => 'armour',
             'name' => 'adds armour',
             'sub_type' => 1,
             'requared_slot' => null
            ],
         ]);

         DB::table('equipment_properties_list')->insert([
            [
             'item_name' => 'additional plates',
             'type' => 'combat',
             'class' => 'armour',
             'low' => 1,
             'normal' => 2,
             'good' => 3,
             'masterpiece' => 6,
             'stat' => 'piercing_damage',
             'name' => 'adds piercing damage ',
             'sub_type' => 1,
             'requared_slot' => null
            ],
         ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $ids = DB::table('game_data.item_list')->whereIn('name', ['weightless chainmail', 'additional plates'])->get()->pluck('id')->toArray();

        DB::table('game_data.equip_detail_list')->whereIn('item_list_id', $ids)->delete();

        DB::table('equipment_properties_list')->whereIn('item_name', ['weightless chainmail', 'additional plates'])->delete();

        DB::table('game_data.item_list')->whereIn('id', $ids)->delete();
    }
};
