import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ games, username }: any) {
    const averagePlaytime = (games.map((g) => g.playtime).reduce((ac, cur) => (ac += cur), 0) / games.length).toFixed(2);
    const playedGames = games.filter((g) => g.status !== 'planning' && g.status != 'not planning').length;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <table>
                <caption>Statistics</caption>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>Games played</td>
                    <td>{playedGames}</td>
                </tr>
                <tr>
                    <td>Average playtime</td>
                    <td>{averagePlaytime}h</td>
                </tr>
            </table>
            <ol className="list-inside list-decimal">
                {games &&
                    games.map((game) => {
                        return (
                            <li>
                                {game.name} {game.status} {game.rating} {game.playtime}
                            </li>
                        );
                    })}
            </ol>
        </AppLayout>
    );
}
