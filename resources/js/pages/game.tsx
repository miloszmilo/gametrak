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
    console.log(game);
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
            <select>
                <option>Plan to play</option>
                <option>Playing</option>
                <option>Completed</option>
                <option>Dropped</option>
            </select>
        </div>
    );
}
