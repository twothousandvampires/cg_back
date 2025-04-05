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
        Schema::table('world.nodes', function (Blueprint $table) {
            $table->integer('w_link')->nullable()->change();
            $table->integer('e_link')->nullable()->change();
            $table->integer('n_link')->nullable()->change();
            $table->integer('s_link')->nullable()->change();
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
