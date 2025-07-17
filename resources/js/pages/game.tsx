import { useState } from 'react';
import { type Game, GameStatus } from '../types/index.d.ts';

type Props = {
    game: Game;
    isLoggedIn: boolean;
    status: GameStatus;
};

export default function GameSite({ game, isLoggedIn, status }: Props) {
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
        fetch('/token', { credentials: 'same-origin' }).then(async (res) => {
            const data = await res.json();
            const csrfToken = data.csrfToken;
            console.log(csrfToken);
            fetch(`/update-game-status/${gameId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    Accept: 'application/json',
                },
                body: JSON.stringify({
                    game_id: gameId,
                    status: status,
                }),
                credentials: 'same-origin',
            })
                .then((res) => {
                    setIsLoading(false);
                    setError('');
                    console.log(res);
                })
                .catch((err) => console.error(err));
        });
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
            <select defaultValue={status} onChange={updateGameStatus} disabled={isLoading || !isLoggedIn}>
                <option value="not planning">Not Planning</option>
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
