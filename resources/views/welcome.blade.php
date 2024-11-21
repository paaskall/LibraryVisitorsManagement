<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan BJ Habibie</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        .swiper {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 300px;
            height: 400px;
        }
        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-book-reader text-blue-600 text-2xl mr-2"></i>
                    <span class="font-bold text-xl text-gray-800">Perpustakaan BJ Habibie</span>
                </div>
<div class="flex items-center">
    @if (Route::has('login'))
        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <a href="#" 
                       onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="text-gray-600 hover:text-blue-600">
                        Logout
                    </a>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
	        <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Register</a>
	@endauth
        </div>
    @endif
</div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Selamat Datang di</span>
                            <span class="block text-blue-600">Perpustakaan BJ Habibie</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Sistem manajemen perpustakaan modern untuk memudahkan proses check-in dan check-out pengunjung.
                        </p>
                        @auth
                        <!-- Check-in Form for Logged In Users -->
                        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Check-in Pengunjung</h3>
                            <form action="{{ route('visitors.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text" name="name" id="name" required 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="member_id" class="block text-sm font-medium text-gray-700">ID Anggota</label>
                                    <input type="text" name="member_id" id="member_id"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="purpose" class="block text-sm font-medium text-gray-700">Tujuan Kunjungan</label>
                                    <select name="purpose" id="purpose" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Pilih Tujuan</option>
                                        <option value="Membaca">Membaca</option>
                                        <option value="Meminjam Buku">Meminjam Buku</option>
                                        <option value="Mengembalikan Buku">Mengembalikan Buku</option>
                                        <option value="Belajar">Belajar</option>
                                        <option value="Penelitian">Penelitian</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                                    <textarea name="notes" id="notes" rows="2"
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Check In
                                    </button>
                                </div>
                            </form>
                        </div>
                        @endauth
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Image Slider Section -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-8">Galeri Perpustakaan</h2>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-4.0.3' }}" alt="Library 1"/>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ 'https://images.unsplash.com/photo-1526721940322-10fb6e3ae94a?ixlib=rb-4.0.3' }}" alt="Library 2"/>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3' }}" alt="Library 3"/>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3' }}" alt="Library 4"/>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ 'https://images.unsplash.com/photo-1504275107627-0c2ba7a43dba?ixlib=rb-4.0.3" alt="Self Study Area' }}" alt="Library 5"/>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Fitur Utama</h2>
            </div>
            <div class="mt-10">
                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <i class="fas fa-sign-in-alt text-white"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Check-in Cepat</h3>
                                    <p class="mt-2 text-sm text-gray-500">Proses check-in yang mudah dan cepat untuk pengunjung perpustakaan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <i class="fas fa-sign-out-alt text-white"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Check-out Otomatis</h3>
                                    <p class="mt-2 text-sm text-gray-500">Sistem check-out yang efisien dengan pencatatan waktu otomatis.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <i class="fas fa-chart-bar text-white"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Statistik Real-time</h3>
                                    <p class="mt-2 text-sm text-gray-500">Pantau statistik pengunjung secara real-time dengan dashboard interaktif.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-base text-gray-400">&copy; 2024 GARP. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    </script>
</body>
</html>
