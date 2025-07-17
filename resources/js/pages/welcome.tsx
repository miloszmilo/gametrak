import { type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { FormEvent, useState } from 'react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;
    const [search, setSearch] = useState<string>('');

    function submit(e: FormEvent<HTMLFormElement>) {
        e.preventDefault();

        fetch(`/search/${search}`, {
            method: 'GET',
        }).then(async (r) => {
            if (r.ok) {
                window.location.href = `/search/${search}`;
                return;
            }
            const error = await r.json();
            console.error(error);
        });
    }

    return (
        <>
            <Head title="Home"></Head>
            <form onSubmit={submit} className="border-2 border-red-500">
                <input value={search} type="text" onChange={(e) => setSearch(e.target.value)} className="bg-blue-500"></input>
                <button type="submit" onClick={() => submit}>
                    Search
                </button>
            </form>
        </>
    );
}
