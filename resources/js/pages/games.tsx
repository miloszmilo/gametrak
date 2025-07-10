export default function ({ games }: { games: Array<any> }) {
    console.log(games[0]);
    return (
        <div>
            {games.map((game) => {
                return (
                    <span>
                        {game.id} {game.name}
                    </span>
                );
            })}
        </div>
    );
}
