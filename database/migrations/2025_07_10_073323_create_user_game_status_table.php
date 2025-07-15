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
            $table->integer('status'); // 0 - not planned, 1 - planning, 2 - playing, 3 - finished, 4 - dropped
            $table->timestamps();
        });

        $user = User::where('name', 'LIKE', 'Admin')->first();
        $game = Game::where('name', 'LIKE', 'Dark Souls')->first();
        $status = UserGameStatus::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'status' => 3,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('user_game_statuses');
    }
};
