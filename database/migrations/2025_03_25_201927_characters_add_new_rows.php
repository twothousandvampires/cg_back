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
        
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('combat_mastery')->default(0);
            $table->integer('sorcery_mastery')->default(0);;
            $table->integer('movement_mastery')->default(0);;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
