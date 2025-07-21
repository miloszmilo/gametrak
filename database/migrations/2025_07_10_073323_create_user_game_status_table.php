<?php

use App\Models\Game;
use App\Models\User;
use App\Models\UserGameStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('user_game_statuses', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('game_id');
            $table->string('status');
            $table->integer('rating');
            $table->integer('playtime');
            $table->timestamps();
        });

        $user = User::where('name', 'LIKE', 'Admin')->first();
        $game = Game::where('name', 'LIKE', 'Dark Souls')->first();
        $status = UserGameStatus::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'status' => 'playing',
            'rating' => 50,
            'playtime' => 100,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('user_game_statuses');
    }
};
