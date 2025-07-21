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
    console.log(username, games);
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
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
