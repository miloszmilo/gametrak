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
            $table->uuid('uuid')->primary();
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
            'description' => "Dark Souls is a 2011 action role-playing game developed by FromSoftware and published by Namco Bandai Games. A spiritual successor to FromSoftware's Demon's Souls, the game is the first in the Dark Souls series. The game takes place in the kingdom of Lordran, where players assume the role of a cursed undead character who escapes from the Northern Undead Asylum and begins a pilgrimage to discover the fate of their kind. A port for Windows featuring additional content, known as the Prepare to Die Edition, was released in August 2012. It was also released for consoles under the subtitle Artorias of the Abyss in October 2012.",
        ]);

        $game = App\Models\Game::create([
            'name' => "Dark Messiah of Might and Magic",
            'categories' => '[arpg, fantasy]',
            'release_year' => 2006,
            'platforms' => '[pc, xbox_360]',
            'studio' => 'Arkane Studios',
            'publisher' => 'Ubisoft',
            'description' => "Dark Messiah of Might and Magic (labeled as Dark Messiah: Might and Magic; additionally subtitled Elements on Xbox 360) is a first-person action role-playing game developed by Arkane Studios. The player controls Sareth, the apprentice of the wizard Phenrig, after he is sent to the city of Stonehelm to accompany an expedition trying to retrieve a powerful artifact known as \"The Skull of Shadows\".",
        ]);

        $game = App\Models\Game::create([
            'name' => "Tony Hawk's Pro Skater",
            'categories' => '[sports, arcade]',
            'release_year' => 1999,
            'platforms' => '[pc, playstation, nintendo_64, game_boy_color, dreamcast, n-gage, brew]',
            'studio' => 'Neversoft',
            'publisher' => 'Activision',
            'description' => "Tony Hawk's Pro Skater takes place in an urban environment permeated by an ambience of punk rock and ska punk music. The player takes control of a variety of skateboarders and must complete missions by performing skateboarding tricks and collecting objects. The game offers several modes of gameplay, including a career mode in which the player must complete objectives and evolve their character's attributes, a single session, in which the player accumulates a high score within two minutes, a free skate mode in which the player may skate without any given objective, and a multiplayer mode that features a number of competitive games.",
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
