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
        Schema::create('games', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->json('categories');
            $table->year('release_year');
            $table->json('platforms');
            $table->string('studio');
            $table->string('publisher');
            $table->text('description');
            $table->timestamps();
        });

        $game = App\Models\Game::create([
            'name' => "Dark Souls",
            'categories' => '[dark_fantasy, arpg]',
            'release_year' => 2011,
            'platforms' => '[pc, playstation_3, xbox_360, playstation_4, xbox_one, nitendo_switch]',
            'studio' => 'FromSoftware',
            'publisher' => 'Namco Bandai Games JP',
            'description' => "Dark Souls is a 2011 action role-playing game developed by FromSoftware and published by Namco Bandai Games. A spiritual successor to FromSoftware's Demon's Souls, the game is the first in the Dark Souls series. The game takes place in the kingdom of Lordran, where players assume the role of a cursed undead character who escapes from the Northern Undead Asylum and begins a pilgrimage to discover the fate of their kind. A port for Windows featuring additional content, known as the Prepare to Die Edition, was released in August 2012. It was also released for consoles under the subtitle Artorias of the Abyss in October 2012. ",
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
