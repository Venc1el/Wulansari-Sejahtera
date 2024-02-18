    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Styles -->
    </head>

    <body class="antialiased bg-dots-darker bg-center dark:bg-dots-lighter dark:bg-gray-900">

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
            <nav class="bg-black">
                <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16 ">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/images/logo.png') }}" class="block h-16" alt="">
                        </a>

                        <div class="flex items-center hidden md:flex">
                            <a href="#"
                                class="text-gray-100 hover:underline underline-offset-8 decoration-primary-green decoration-2">Produk</a>
                            <a href="#"
                                class="ml-4 text-gray-100 hover:underline underline-offset-8 decoration-primary-green decoration-2 ">Galeri</a>
                            <a href="#"
                                class="ml-4 text-gray-100 hover:underline underline-offset-8 decoration-primary-green decoration-2">Berita</a>
                            <a href="#"
                                class="ml-4 text-gray-100 hover:underline underline-offset-8 decoration-primary-green decoration-2">Kontak</a>
                            <div class="relative">
                                <button id="tentang-kami-dropdown"
                                    class="inline-flex items-center justify-center h-10 px-4 text-gray-100 hover:underline underline-offset-8 decoration-primary-green decoration-2">
                                    Tentang Kami

                                    <svg class="-mr-1 h-5 w-5 text-gray-100" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div id="tentang-kami-dropdown-menu"
                                    class="hidden absolute left-0 z-10 mt-2 w-48 origin-top-left rounded-md bg-primary-green shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                    tabindex="-1">
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-100 hover:bg-primary-yellow focus:bg-primary-yellow">Sejarah
                                        Perusahaan</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-100 hover:bg-primary-yellow focus:bg-primary-yellow">Informasi
                                        Perusahaan</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-100 hover:bg-primary-yellow focus:bg-primary-yellow">Legalitas</a>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            @include('components.cart-modal')
                            <div class="hidden md:block">
                                <div class="flex items-center">
                                    @if (Route::has('login'))
                                        @auth
                                            @if (Auth::user()->role === 'admin')
                                                <a href="{{ url('/dashboard') }}"
                                                    class="font-semibold text-gray-100 hover:underline">Dashboard</a>
                                            @endif
                                            <form method="POST" action="{{ route('logout') }}" class="ml-4">
                                                @csrf
                                                <button type="submit"
                                                    class="font-semibold text-gray-100 hover:underline">Logout
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="font-semibold text-gray-100 hover:underline ml-4">Log in</a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                    class="ml-4 font-semibold text-gray-100 hover:underline">Register</a>
                                            @endif
                                        @endauth
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center">
                                <button id="mobile-menu-btn"
                                    class="md:hidden ml-1 inline-flex items-center justify-center p-2 text-gray-400 hover:text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                    aria-label="Main menu" aria-expanded="false">
                                    <svg class="block h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16m-7 6h7">
                                        </path>
                                    </svg>
                                    <svg class="hidden h-6 w-6" stroke="currentColor" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="hidden md:hidden" id="mobile-menu">
                    <div class="px-2 pt-2 pb-3 sm:px-3">
                        <a href="#"
                            class="block px-4 py-2 text-gray-100 hover:bg-gray-700 hover:text-white">Tentang Kami</a>
                        <a href="#"
                            class="block px-4 py-2 text-gray-100 hover:bg-gray-700 hover:text-white">Produk</a>
                        <a href="#"
                            class="block px-4 py-2 text-gray-100 hover:bg-gray-700 hover:text-white">Galeri</a>
                        <a href="#"
                            class="block px-4 py-2 text-gray-100 hover:bg-gray-700 hover:text-white">Berita</a>
                        <a href="#"
                            class="block px-4 py-2 text-gray-100 hover:bg-gray-700 hover:text-white">Kontak</a>
                        @if (Route::has('login'))
                            <div
                                class="block px-4 py-2 text-gray-100 font-semibold hover:bg-gray-700 hover:text-white rounded-md">
                                @auth
                                    @if (Auth::user()->role === 'admin')
                                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit">Logout</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}">Log in</a>
                                </div>
                                <div
                                    class="block px-4 py-2 text-gray-100 font-semibold hover:bg-gray-700 hover:text-white rounded-md">
                                    <a href="{{ route('register') }}">Register</a>
                                </div>
                            @endauth
                        @endif
                    </div>
                </div>
            </nav>

            <div
                class="max-w-8xl mx-auto px-4 py-12 md:mt-20 sm:px-6 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <div class="lg:w-1/2">
                    <img class="h-64 w-full object-cover object-center rounded-lg shadow-lg lg:h-auto"
                        src="{{ asset('assets/images/rrr.png') }}" alt="Placeholder Image">
                </div>
                <div class="mt-8 lg:mt-0 lg:w-1/2 lg:ml-10">
                    <h2 class="text-3xl font-extrabold leading-tight text-primary-green sm:text-4xl">PT. Wulan Sari
                        Sejahtera</h2>
                    <p class="mt-4 text-lg text-black">Merupakan sebuah perusahaan yang bergerak di bidang produksi
                        komoditas beras yang dikelola secara professional dengan komitmen tinggi memberikan pelayanan
                        dan kualitas terbaik untuk customer dengan menjamin kualitas produk yang bermutu tinggi dan
                        diolah menggunakan teknologi pangan terbaik dari Jerman. </p>
                    <div class="mt-6">
                        <a href="#"
                            class="inline-block px-6 py-3 border border-transparent text-base leading-6 font-medium text-white bg-primary-green hover:bg-primary-yellow focus:outline-none focus:border-primary-yellow focus:shadow-outline-primary transition duration-150 ease-in-out">Pesan
                            Produk</a>
                    </div>
                </div>
            </div>

            <div class="bg-black md:mt-20">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="lg:flex lg:justify-between">

                        <div class="lg:w-1/2">
                            <div>
                                <h3 class="text-3xl font-bold text-primary-yellow">Visi</h3>
                                <p class="mt-4 text-lg text-gray-300">Menjadi salah satu perusahaan pengolahan pangan
                                    yang terbaik di Indonesia Timur</p>
                            </div>
                        </div>

                        <div class="mt-8 lg:mt-0 lg:w-1/2 lg:ml-10">
                            <div>
                                <h3 class="text-3xl font-bold text-primary-yellow">Misi</h3>
                                <p class="mt-4 text-lg text-gray-300">Selalu mengupgrade kualitas dan kuantitas
                                    produksi melalui penggunaan teknologi pangan yang terbaik <br>Berkontribusi secara
                                    aktif dalam memperluas jaringan marketing dengan mempermudah proses distribusi <br>
                                    Meningkatkan penyerapan tenaga kerja dan karyawan demi membantu kesejahteraan
                                    masyarakat sekitar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Kami section -->
            <div class="bg-white">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="text-center">
                            <h2 class="text-3xl font-extrabold leading-tight sm:text-4xl text-primary-green">Produk
                                Kami
                            </h2>
                            <p class="mt-4 text-lg text-gray-600">Memproduksi beras berkualitas tinggi dengan proses
                                pengemasan yang higienis dan memastikan
                                beras yang kami olah berasal dari beras berkualitas dari petani di wilayah jawa timur.
                            </p>
                        </div>
                    </div>
                    <div class="mt-12 grid gap-6 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
                        @foreach ($items as $item)
                            <div
                                class="bg-gray-200 rounded-lg overflow-hidden shadow-lg motion-safe:hover:scale-[1.01] transition-all duration-250">
                                <img class="w-full h-72 object-cover object-center"
                                    src="{{ asset('assets/images/' . $item->image) }}" alt="Product Image">
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $item->item_name }}</h3>
                                    <p class="mt-2 text-gray-600 font-semibold">
                                        Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                    <div class="mt-4">
                                        <button onclick="addToCart('{{ $item->id }}')"
                                            class="text-primary-green hover:text-primary-yellow font-semibold">Order
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <nav class="bg-gray-900 text-white py-4 max-w-7xl mx-auto">
                <div class="container mx-auto flex justify-center">
                    <a href="#sejarahContent" onclick="showSection('sejarah')"
                        class="mr-6 hover:underline">Sejarah</a>
                    <a href="#informasiContent" onclick="showSection('informasi')"
                        class="mr-6 hover:underline">Informasi</a>
                    <a href="#legalitasContent" onclick="showSection('legalitas')"
                        class="hover:underline">Legalitas</a>
                </div>
            </nav>

            <div class="mx-auto text-center max-w-5xl py-8">
                <!-- Sejarah Section -->
                <div id="sejarahContent" class="mb-8">
                    <h1 class="text-3xl font-bold text-primary-green">Sejarah Perusahaan</h1>
                    <p class="mt-4 text-justify ">PT. WULAN SARI SEJAHTERA didirikan pada tahun 2020 melalui akta
                        notaris
                        Yekti Utami, S.H., M.Kn dan dengan SK KEMENKUMHAM No. AHU-0048697.AH.01.01.
                        Tahun 2020 yang beralamatkan di Dusun Patuk Pulo No.2, Desa Sidomulyo, Kec. Krian, Kabupaten
                        Sidoarjo, Jawa Timur.
                        Perusahaan ini dipimpin oleh Bapak Suhernowo yang menjabat sebagai Direktur dan Bapak Dwi
                        Purwanto Bersama Ibu Titik Sugiati yang menjabat sebagai Komisaris.
                    </p>
                    <div class="mt-8 md:px-44">
                        <img src="{{ asset('assets/images/sej1.png') }}" alt="Photo"
                            class="w-full h-auto rounded-xl shadow-lg motion-safe:hover:scale-[1.01] transition-all duration-250">
                    </div>
                </div>

                <!-- Informasi Section -->
                <div id="informasiContent" class="mb-8 hidden">
                    <h1 class="text-3xl font-bold text-primary-green text-center">Informasi Perusahaan PT. Wulan Sari
                        Sejahtera</h1>
                    <div class="mt-8">
                        <span class="font-bold">Alamat Kantor :</span>
                        <p>Dusun Patuk Pulo No.2, Desa Sidomulyo, Kec.Krian, Kabupaten Sidoarjo, Jawa Timur</p>
                    </div>
                    <div class="mt-4">
                        <span class="font-bold">Alamat Pabrik :</span>
                        <p>Dusun Patuk Pulo No.2, Desa Sidomulyo, Kec.Krian, Kabupaten Sidoarjo, Jawa Timur</p>
                    </div>
                    <div class="mt-4">
                        <span class="font-bold"> Akta Notaris : </span>
                        <p> Yekti Utami, SH., M.Kn</p>
                    </div>
                    <div class="mt-4">
                        <span class="font-bold"> SK Menkumham : </span>
                        <p> No. AHU-0048697.AH.01.01 Tahun 2020</p>
                    </div>
                    <div class="mt-4">
                        <span class="font-bold"> NIB: </span>
                        <p> 0200000942699</p>
                    </div>
                    <div class="mt-4">
                        <span class="font-bold"> NPWP : </span>
                        <p> 96.056.788.1-603.000</p>
                    </div>
                    <div class="mt-4">
                        <span class="font-bold"> Sertifikasi Halal : </span>
                        <p> LPPOM-JL-07190010890422</p>
                    </div>
                    <div class="mt-4">
                        <span class="font-bold"> Kemtan RI : </span>
                        <p> PDUK 351501010430422</p>
                    </div>
                </div>

                <!-- Legalitas Section -->
                <div id="legalitasContent" class="hidden">
                    <h1 class="text-3xl font-bold">Legalitas Produk</h1>
                    <p class="mt-4">Secara Legal produk kami telah tersertifikasi Halal LPPOM dan terdaftar KEMTAN
                        RI.
                        Untuk memberikan hasil produksi kualitas terbaik, kami juga menggunakan teknologi
                        pangan dari Jerman.
                    </p>
                    <div class="mt-8 grid grid-cols-4 gap-4 md:px-24">
                        <img src="{{ asset('assets/images/l2.png') }}"
                            class="w-full h-auto shadow-xl motion-safe:hover:scale-[1.1] transition-all duration-250">
                        <img src="{{ asset('assets/images/legalitas3.png') }}"
                            class="w-full h-auto shadow-xl motion-safe:hover:scale-[1.1] transition-all duration-250">
                        <img
                            src="{{ asset('assets/images/l3.png') }}"class="w-full h-auto shadow-xl motion-safe:hover:scale-[1.1] transition-all duration-250">
                        <img
                            src="{{ asset('assets/images/legalitas4.png') }}"class="w-full h-auto shadow-xl motion-safe:hover:scale-[1.1] transition-all duration-250">
                    </div>
                </div>
            </div>

            <footer class="bg-black text-white py-4">
                <div class="container mx-auto flex flex-col items-center justify-center">
                    <p class="mb-2">"Supplier dan Distributor Perdagangan Beras"</p>
                    <p>&copy; 2024 Pt.Wulan Sari Sejahtera. All rights reserved.</p>
                    <ul class="flex justify-center mt-4">
                        <li class="mx-2">
                            <a target="_blank" rel="noreferrer"
                                href="https://www.instagram.com/beraspremiumsby?igsh=MTh2cm03amxra3Vvbw==">
                                <i class="fab fa-instagram text-white mr-1"></i>
                            </a>
                        </li>
                        <li class="mx-2">
                            <a target="_blank" rel="noreferrer"
                                href="https://www.tiktok.com/@beraspremiumsby_?_t=8jNvCH4mhPk&_r=1">
                                <i class="fab fa-tiktok text-white mr-1"></i>
                            </a>
                        </li>
                        <li class="mx-2">
                            <a target="_blank" rel="noreferrer" href="mailto:wulansarisejahtera@gmail.com">
                                <i class="fas fa-envelope text-white mr-1"></i>
                            </a>
                        </li>
                        <li class="mx-2">
                            <a target="_blank" rel="noreferrer" href="https://wa.me/081335593418">
                                <i class="fab fa-whatsapp text-white mr-1"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://kit.fontawesome.com/43133f443d.js" crossorigin="anonymous"></script>
        <script>
            function addToCart(itemId) {
                @auth
                fetch(`/cart/add/${itemId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            @else
                alert('Please login to add item to cart.');
                window.location.href = '{{ route('login') }}';
            @endauth
            }
        </script>
    </body>

    </html>
