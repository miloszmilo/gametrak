<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_game_status', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('game_id');
            $table->integer('status'); // 0 - not planned, 1 - planning, 2 - playing, 3 - finished, 4 - dropped
            $table->timestamps();
        });
        /* DB::statement('
            ALTER TABLE user_game_status
            ADD CONSTRAINT status CHECK (status >= 0 AND status <= 4)
        '); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_game_status');
    }
};
