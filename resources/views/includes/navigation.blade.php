{{-- https://tailwindcomponents.com/component/responsive-navbar-with-dropdown --}}

<div class="w-full text-gray-700 bg-white border-t-2 border-indigo-500">
    <div x-data="{ open: false }" class="flex flex-col max-w-screen-3xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <div class="p-4 flex flex-row items-center justify-between">
            <a href="{{ route('home') }}">@include('includes.svg.academic-cap')</a>

            <a href="{{ route('home') }}" class="text-lg tracking-wide text-gray-900 rounded-lg focus:outline-none focus:shadow-outline">Braxton <span class="font-semibold text-indigo-500">Fair</span></a>

            <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                @include('includes.svg.hamburger')
            </button>
        </div>

        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
            <a class="navbar-item {{ Route::currentRouteName() == 'home' ? 'selected' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="navbar-item {{ Route::currentRouteName() == 'about' ? 'selected' : '' }}" href="{{ route('about') }}">About</a>
            <a class="navbar-item {{ strstr(Route::currentRouteName(), 'blog') ? 'selected' : '' }}" href="{{ route('blog.index') }}">Blog</a>

            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-indigo-500 rounded-lg md:w-auto md:inline md:mt-0 md:ml-4 text-white hover:text-gray-200 focus:text-gray-200 hover:bg-indigo-600 focus:bg-indigo-600 focus:outline-none focus:shadow-outline">
                <span>Honors</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                    <div class="px-2 py-2 bg-white rounded-md shadow">
                        <a class="dropdown-item {{ Route::currentRouteName() == 'honors.index' ? 'selected' : '' }}" href="{{ route('honors.index') }}">The Program</a>
                        <hr class="px-2 my-2">
                        <a class="dropdown-item {{ Route::currentRouteName() == 'honors.research' ? 'selected' : '' }}" href="{{ route('honors.research') }}">Research</a>
                        <a class="dropdown-item {{ Route::currentRouteName() == 'honors.leadership' ? 'selected' : '' }}" href="{{ route('honors.leadership') }}">Leadership</a>
                        <a class="dropdown-item {{ Route::currentRouteName() == 'honors.global-citizenship' ? 'selected' : '' }}" href="{{ route('honors.global-citizenship') }}">Global Citizenship</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
