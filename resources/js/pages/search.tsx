export default function ({ games }: { games: Array<any> }) {
    return (
        <div>
            <ul>
                {games.map((game, index) => {
                    return (
                        <li key="index">
                            {game.uuid} {game.name}
                        </li>
                    );
                })}
            </ul>
        </div>
    );
}
