<nav x-data="{ open: false }" class="border-b border-emerald-900 bg-[#08110d] text-gray-200">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-emerald-400" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                        class="!text-gray-300 hover:!text-emerald-300 [&[aria-current=page]]:!border-emerald-400 [&[aria-current=page]]:!text-emerald-300"
                    >
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link
                        :href="route('feedback')"
                        :active="request()->routeIs('feedback')"
                        class="!text-gray-300 hover:!text-emerald-300 [&[aria-current=page]]:!border-emerald-400 [&[aria-current=page]]:!text-emerald-300"
                    >
                        {{ __('Feedback') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden items-center gap-2 sm:flex sm:ms-6">
                @livewire('notification-bell')

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-md border border-emerald-900 bg-[#10251b] px-3 py-2 text-sm font-medium leading-4 text-gray-200 transition duration-150 ease-in-out hover:bg-[#173625] hover:text-emerald-200 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-300 transition duration-150 ease-in-out hover:bg-[#173625] hover:text-emerald-300 focus:bg-[#173625] focus:text-emerald-300 focus:outline-none"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden border-t border-emerald-900 bg-[#0b1711] sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
                class="!text-gray-300 hover:!bg-[#10251b] hover:!text-emerald-300 [&[aria-current=page]]:!border-emerald-400 [&[aria-current=page]]:!bg-[#10251b] [&[aria-current=page]]:!text-emerald-300"
            >
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('feedback')"
                :active="request()->routeIs('feedback')"
                class="!text-gray-300 hover:!bg-[#10251b] hover:!text-emerald-300 [&[aria-current=page]]:!border-emerald-400 [&[aria-current=page]]:!bg-[#10251b] [&[aria-current=page]]:!text-emerald-300"
            >
                {{ __('Feedback') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-emerald-900 pb-1 pt-4">
            <div class="px-4">
                <div class="text-base font-medium text-gray-100">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link
                    :href="route('profile.edit')"
                    class="!text-gray-300 hover:!bg-[#10251b] hover:!text-emerald-300"
                >
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        class="!text-gray-300 hover:!bg-[#10251b] hover:!text-emerald-300"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>