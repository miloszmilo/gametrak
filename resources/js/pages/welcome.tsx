import { type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import debounce from 'lodash.debounce';
import { ChangeEvent, FormEvent, useCallback, useState } from 'react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;
    const [search, setSearch] = useState<string>('');

    const debouncedOnChange = useCallback(debounce(changeSearch, 200), [changeSearch, debounce]);
    function changeSearch(e: ChangeEvent<HTMLInputElement>) {
        console.log('Setting search');
        setSearch(e.target.value);
    }

    function submit(e: FormEvent<HTMLFormElement>) {
        console.log('Submitting');
        e.preventDefault();
        fetch(`/search/${search}`, {
            method: 'GET',
        }).then(async (r) => {
            if (r.ok) window.location.href = `/search/${search}`;
            else {
                const error = await response.json();
                console.error(error);
            }
        });
    }

    return (
        <>
            <Head title="Home"></Head>
            <form onSubmit={submit} className="border-2 border-red-500">
                <input type="text" onChange={debouncedOnChange} className="bg-blue-500"></input>
                <button type="submit" onClick={() => submit}>
                    Search
                </button>
            </form>
        </>
    );
}
