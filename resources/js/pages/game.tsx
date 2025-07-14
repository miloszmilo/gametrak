import { useState } from 'react';
import { GameStatus } from '../types/index.d.ts';

export type Game = {
    name: string;
    release_year: string;
    description: string;
    studio: string;
    publisher: string;
    categories: string; // in db it's string array '[item1, item2]'
    platforms: string; // in db it's string array '[item1, item2]'
};

export default function Game({ id, game }: { id: number; game: any }) {
    const [error, setError] = useState<string>('');
    const [isLoading, setIsLoading] = useState<boolean>(false);
    function updateGameStatus(e) {
        setError('');
        setIsLoading(true);
        console.log(e.target.value);

        // get user id inside php
        // for currently logged in user
        // send request
        const gameId = game.id;
        const status: GameStatus = e.target.value.trim().toLowerCase();
        if (!Object.values(GameStatus).includes(status)) {
            setError("Game status isn't valid. Try again.");
            setIsLoading(false);
            return;
        }
        fetch(`/update-game-status/${gameId}`, {
            method: 'POST',
        });
        setIsLoading(false);
    }

    return (
        <div>
            <div>
                <h1>{game.name}</h1>
                <span>{game.release_year}</span>
            </div>
            <p>{game.description}</p>
            <p>{game.studio}</p>
            <p>{game.publisher}</p>
            <ul>
                {game.categories
                    .replace('[', '')
                    .replace(']', '')
                    .split(',')
                    .map((category: string, index: number) => {
                        return <li key={index}>{category}</li>;
                    })}
            </ul>
            <ul>
                {game.platforms
                    .replace('[', '')
                    .replace(']', '')
                    .split(',')
                    .map((platform: string, index: number) => {
                        return <li key={index}>{platform}</li>;
                    })}
            </ul>
            <select onChange={updateGameStatus} disabled={isLoading}>
                <option value="planning">Plan to play</option>
                <option value="playing">Playing</option>
                <option value="completed">Completed</option>
                <option value="dropped">Dropped</option>
            </select>
            {error && <span>{error}</span>}
        </div>
    );
}
