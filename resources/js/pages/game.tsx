export default function Game({ id, game }: { id: number; game: any }) {
    console.log(game);
    return (
        <div>
            Game of id {id}.{game}
        </div>
    );
}
