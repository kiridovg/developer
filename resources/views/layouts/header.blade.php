<header class=" d-flex flex-column flex-md-row p-3 px-md-4 mb-3 bg-body shadow-sm">
    <h5 class="h5"><a class="flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0" href="/">NIX</a></h5>

    <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

    </div>
</header>
