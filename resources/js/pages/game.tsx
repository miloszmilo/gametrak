import { useState } from 'react';
import { type Game, GameStatus } from '../types/index.d.ts';

export default function GameSite({ game, isLoggedIn }: { game: Game; isLoggedIn: boolean }) {
    const [error, setError] = useState<string>('');
    const [isLoading, setIsLoading] = useState<boolean>(false);

    function updateGameStatus(e: React.ChangeEvent<HTMLSelectElement>) {
        setError('');
        setIsLoading(true);

        const gameId = game.id;
        const status: GameStatus = e.target.value.trim().toLowerCase() as GameStatus;
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
            <select onChange={updateGameStatus} disabled={isLoading || !isLoggedIn}>
                <option value="planning">Plan to play</option>
                <option value="playing">Playing</option>
                <option value="completed">Completed</option>
                <option value="dropped">Dropped</option>
            </select>
            {!isLoggedIn && <span>Log in to update your game status!</span>}
            {error && <span>{error}</span>}
        </div>
    );
}
