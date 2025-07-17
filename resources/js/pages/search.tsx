export default function ({ games }: { games: Array<any> }) {
    return (
        <div>
            <ol>
                {games.map((game, index) => {
                    return (
                        <li className="flex flex-row gap-2" key="index">
                            {game.name}
                            <a href={`/game/${game.id}`}>Go to game</a>
                        </li>
                    );
                })}
            </ol>
        </div>
    );
}
