export default function ({ games }: { games: Array<any> }) {
    return (
        <div className="flex flex-col items-center justify-items-center">
            <span className="text-lg">Search Results</span>
            <ul className="flex flex-col gap-4">
                {games.map((game, index) => {
                    console.log(game);
                    return (
                        <li className="flex flex-col gap-2 rounded-md bg-orange-200 p-4" key={index}>
                            <div className="flex flex-col">
                                <span className="text-md font-semibold text-orange-900">{game.name}</span>
                                <span className="line-clamp-3 overflow-ellipsis">{game.description}</span>
                                <ul>
                                    <caption>Categories:</caption>
                                    {game.categories
                                        .split(',')

                                        .map((category, i) => {
                                            return <li key={i}>{category.replace('[', '').replace(']', '').trim()}</li>;
                                        })}
                                </ul>
                            </div>
                            <a href={`/game/${game.id}`} className="text-blue-500 underline hover:text-blue-400">
                                Go to game
                            </a>
                        </li>
                    );
                })}
            </ul>
        </div>
    );
}
