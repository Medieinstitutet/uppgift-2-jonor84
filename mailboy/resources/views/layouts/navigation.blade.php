<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Admin Dashboard') }}
                            </x-nav-link>
                        @elseif(auth()->user()->hasRole('client'))
                            <x-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">
                                {{ __('Client Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('client.mynewsletters')" :active="request()->routeIs('client.mynewsletters')">
                                {{ __('My Newsletters') }}
                            </x-nav-link>
                        @elseif(auth()->user()->hasRole('subscriber'))
                            <x-nav-link :href="route('subscriber.dashboard')" :active="request()->routeIs('subscriber.dashboard')">
                                {{ __('Subscriber Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('subscriber.allnewsletters')" :active="request()->routeIs('subscriber.allnewsletters')">
                                {{ __('Newsletters') }}
                            </x-nav-link>
                        @endif
                    @else
                        <x-nav-link :href="route('public.dashboard')" :active="request()->routeIs('public.dashboard')">
                            {{ __('Start') }}
                        </x-nav-link>
                        <x-nav-link :href="route('public.allnewsletters')" :active="request()->routeIs('public.allnewsletters')">
                            {{ __('Newsletters') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }} ({{ ucfirst(auth()->user()->roles->first()->name) }}) <i class="bi bi-person-circle ml-1" style="font-size: 18px;"></i></div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 1 1 1.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                            <i class="bi bi-person-fill mr-2" style="font-size: 18px;"></i> {{ __('Profile') }}  
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <i class="bi bi-box-arrow-in-left mr-2" style="font-size: 18px;"></i> {{ __('Logout') }} 
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-500 mr-2"><i class="bi bi-person-add"></i> Register</a> | 
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 ml-2"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('public.dashboard')" :active="request()->routeIs('public.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else

                <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
