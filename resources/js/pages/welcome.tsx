import { Head } from '@inertiajs/react';
import { FormEvent, useState } from 'react';

export default function Welcome() {
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
            <main className="mt-64 flex min-h-[100%] min-w-[100%] flex-col items-center justify-items-center">
                <form className="flex flex-row">
                    <input
                        value={search}
                        type="text"
                        onChange={(e) => setSearch(e.target.value)}
                        className="rounded-l-full bg-neutral-800 px-4 py-2 text-neutral-200"
                        placeholder="Search by game name"
                    ></input>
                    <button
                        type="submit"
                        onClick={submit}
                        className="cursor-pointer rounded-r-full bg-orange-300 px-2 text-orange-900 hover:bg-orange-200 hover:text-orange-800"
                    >
                        Search
                    </button>
                </form>
            </main>
        </>
    );
}
