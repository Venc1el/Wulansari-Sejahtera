    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Styles -->
    </head>

    <body
        class="antialiased bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        @if (session('success'))
            <script>
                Swal.fire({
                    title: "Thank You",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            </script>
        @endif

        <div class="relative">
            <div class="flex justify-between items-center p-6">
                <h1>Logo Nih</h1>

                @if (Route::has('login'))
                    <div class="">
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ url('/dashboard') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        @foreach ($items as $item)
                            <form action="{{ route('place.order') }}" method="post"
                                class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <div>
                                    <div
                                        class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                        <i class="fas fa-envelope text-red-500"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-400">
                                        {{ $item->item_name }}
                                    </h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste qui expedita aut
                                        culpa quibusdam nisi, aliquid, neque assumenda nostrum sint natus, eveniet
                                        pariatur illo perferendis!
                                    </p>
                                    <span class="text-gray-900 dark:text-gray-400 mt-2">
                                        {{ $item->price }}
                                    </span>
                                </div>

                                <button type="submit"
                                    class="ml-auto bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                    Order
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/43133f443d.js" crossorigin="anonymous"></script>
    </body>

    </html>
