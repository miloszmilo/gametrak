import { useState } from 'react';
import { type Game, GameStatus } from '../types/index.d.ts';

type Props = {
    game: Game;
    isLoggedIn: boolean;
    _status: GameStatus;
    _rating: number;
    _playtime: number;
};

export default function GameSite({ game, isLoggedIn, _status, _rating, _playtime }: Props) {
    const [error, setError] = useState<string>('');
    const [isLoading, setIsLoading] = useState<boolean>(false);
    const [status, setStatus] = useState<GameStatus>(_status);
    const [rating, setRating] = useState<number>(_rating);
    const [playtime, setPlaytime] = useState<number>(_playtime);

    function updateRating(e: React.ChangeEvent<HTMLInputElement>) {
        try {
            const inputRating = Number(e.target.value);
            const finalRating = Math.min(100, Math.max(0, inputRating));
            setRating(finalRating);
        } catch (err) {
            console.error(err);
            return;
        }
    }

    function updatePlaytime(e: React.ChangeEvent<HTMLInputElement>) {
        try {
            const inputPlaytime = Number(e.target.value);
            const finalPlaytime = Math.min(99999, Math.max(0, inputPlaytime));
            setPlaytime(finalPlaytime);
        } catch (err) {
            console.error(err);
            return;
        }
    }

    function updateGameStatus(e: React.ChangeEvent<HTMLSelectElement>) {
        setError('');

        const status: GameStatus = e.target.value.trim().toLowerCase() as GameStatus;

        if (!Object.values(GameStatus).includes(status)) {
            setError("Game status isn't valid. Try again.");
            return;
        }
        setStatus(status);
    }

    function submitForm(e: React.FormEvent<HTMLFormElement>) {
        setError('');
        setIsLoading(true);
        e.preventDefault();
        const gameId = game.id;

        fetch('/token', { credentials: 'same-origin' }).then(async (res) => {
            const data = await res.json();
            const csrfToken = data.csrfToken;
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
                    rating: rating,
                    playtime: playtime,
                }),
                credentials: 'same-origin',
            })
                .catch((err) => {
                    setError('Something went wrong with the request. Try again later.');
                    console.error(err);
                })
                .finally(() => {
                    setIsLoading(false);
                });
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
            <form onSubmit={submitForm}>
                <select defaultValue={_status ?? 'not planning'} onChange={updateGameStatus} disabled={isLoading || !isLoggedIn}>
                    <option value="not planning">Not Planning</option>
                    <option value="planning">Plan to play</option>
                    <option value="playing">Playing</option>
                    <option value="completed">Completed</option>
                    <option value="dropped">Dropped</option>
                </select>
                {!isLoggedIn && <span>Log in to update your game status!</span>}
                {error && <span>{error}</span>}

                <input
                    defaultValue={_rating ?? ''}
                    onInput={updateRating}
                    disabled={isLoading || !isLoggedIn}
                    type="number"
                    min="0"
                    max="100"
                    step="1"
                    className="peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500"
                    placeholder={`${Math.round(Math.random() * 100)}`}
                    pattern="\d{1,3}"
                ></input>
                <input
                    defaultValue={_playtime ?? ''}
                    onInput={updatePlaytime}
                    disabled={isLoading || !isLoggedIn}
                    type="number"
                    min="0"
                    max="99999"
                    step="1"
                    pattern="\d{1,5}"
                    placeholder="1000"
                ></input>
                <span className="hidden text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Rating must be in range 0-100 and a whole number!
                </span>
                <button type="submit" className="cursor:pointer rounded-md bg-blue-500 p-2">
                    Save
                </button>
            </form>
        </div>
    );
}
