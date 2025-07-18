import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export enum GameStatus {
    NOT_PLANNING = 'not planning',
    PLANNING = 'planning',
    PLAYING = 'playing',
    COMPLETED = 'completed',
    DROPPED = 'dropped',
}

export interface Game {
    id: string;
    name: string;
    release_year: string;
    description: string;
    studio: string;
    publisher: string;
    categories: string; // in db it's string array '[item1, item2]'
    platforms: string; // in db it's string array '[item1, item2]'
}
