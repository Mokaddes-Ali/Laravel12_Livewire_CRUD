<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <!-- Sidebar -->
    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <!-- Logo -->
        <a navigate href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2 p-4">
            <x-app-logo />
            <span class="text-lg font-semibold text-zinc-900 dark:text-white">Dashboard</span>
        </a>

        <!-- Main Navigation -->
        <flux:navlist.group :heading="__('Platform')" class="grid">
            <flux:navlist.item
                icon="home"
                :href="route('dashboard')"
                :current="request()->routeIs('dashboard')"
                wire:navigate
                class="px-4 py-2 rounded-lg transition-all hover:bg-zinc-200 dark:hover:bg-zinc-700"
                :class="request()->routeIs('dashboard') ? 'bg-zinc-200 text-white' : 'text-zinc-900 dark:text-white'"
            >
                {{ __('Dashboard') }}
            </flux:navlist.item>

            <flux:navlist.item
                icon="users"
                :href="url('/users')"
                wire:navigate
                class="px-4 py-2 rounded-lg transition-all hover:bg-zinc-200 dark:hover:bg-zinc-700"
                :class="request()->is('users') ? 'bg-zinc-200 text-white' : 'text-zinc-900 dark:text-white'"
            >
                {{ __('Manage User') }}
            </flux:navlist.item>

            <flux:navlist.item
                icon="users"
                :href="route('roles.index')"
                wire:navigate
                class="px-4 py-2 rounded-lg transition-all hover:bg-zinc-200 dark:hover:bg-zinc-700"
                :class="request()->routeIs('roles.index') ? 'bg-zinc-200 text-white' : 'text-zinc-900 dark:text-white'"
            >
                {{ __('Manage Role') }}
            </flux:navlist.item>

            <flux:navlist.item
            icon="users"
            :href="route('create.course')"
            wire:navigate
            class="px-4 py-2 rounded-lg transition-all hover:bg-zinc-200 dark:hover:bg-zinc-700"
            :class="request()->routeIs('create.course') ? 'bg-zinc-200 text-white' : 'text-zinc-900 dark:text-white'"
        >
            {{ __('Courses') }}
        </flux:navlist.item>

        <div class="w-64 h-screen bg-gray-800 text-white">
            <ul>
                <li class="p-4 hover:bg-gray-700">
                    <a href="{{ route('users.index') }}">Chats</a>
                </li>
            </ul>
        </div>
        
        </flux:navlist.group>

        <flux:spacer />

        <!-- External Links -->
        <flux:navlist variant="outline">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="px-4 py-2 rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all">
                {{ __('Repository') }}
            </flux:navlist.item>

            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits" target="_blank" class="px-4 py-2 rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all">
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down"
                class="px-4 py-2 rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all"
            />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>
                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="px-4 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all">
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full px-4 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" class="px-4 py-2 rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="px-4 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all">
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full px-4 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>
</html>

