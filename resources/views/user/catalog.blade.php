<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-indigo-900 overflow-hidden" 
         x-data="{ currentImage: 0, images: ['{{ asset('images/backgrounds/gambar1-HeroBackground-Catalog-Fix.png') }}', '{{ asset('images/backgrounds/gambar2-HeroBackground-Catalog-Fix.png') }}', '{{ asset('images/backgrounds/gambar3-HeroBackground-Catalog-Fix.png') }}'] }" 
         x-init="setInterval(() => currentImage = (currentImage + 1) % images.length, 4000)">
        <div class="absolute inset-0">
            <template x-for="(image, index) in images" :key="index">
                <img :src="image" alt="Hero background" 
                     class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out"
                     :class="currentImage === index ? 'opacity-30' : 'opacity-0'" />
            </template>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 flex flex-col items-center text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Temukan Barang Impianmu</h1>
            <p class="mt-6 max-w-3xl text-xl text-indigo-100">Jelajahi koleksi produk premium terbaik kami dengan harga yang tak tertandingi di pasaran. PT ChipiChapa menjamin kualitas 100%.</p>
        </div>
    </div>

    <!-- Product Grid Section -->
    <div class="bg-gray-50 dark:bg-gray-900 py-12 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 flex items-center bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 rounded-r-lg p-4 shadow-sm" role="alert">
                    <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-8 flex items-center bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 rounded-r-lg p-4 shadow-sm" role="alert">
                    <svg class="h-6 w-6 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="text-red-800 dark:text-red-300 font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Koleksi Terbaru</h2>
                
                <a href="{{ route('checkout') }}" class="group relative inline-flex items-center justify-center px-8 py-3 text-base font-bold text-white transition-all duration-200 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-full overflow-hidden shadow-lg hover:shadow-xl hover:-translate-y-1">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:animate-bounce" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                        Keranjang Saya 
                        @if(count(session('cart', [])) > 0)
                            <span class="flex items-center justify-center bg-white text-indigo-600 rounded-full h-6 w-6 text-xs font-black">{{ count(session('cart', [])) }}</span>
                        @endif
                    </span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                <div class="group bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl dark:shadow-none dark:hover:ring-2 dark:hover:ring-indigo-500 transition-all duration-300 overflow-hidden flex flex-col transform hover:-translate-y-2">
                    <div class="relative aspect-w-1 aspect-h-1 bg-gray-100 dark:bg-gray-900 overflow-hidden">
                        @if($product->foto_barang)
                            <img src="{{ asset('storage/' . $product->foto_barang) }}" class="w-full h-64 object-cover transform transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-64 flex flex-col items-center justify-center text-gray-400 dark:text-gray-600 bg-gray-200 dark:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-semibold uppercase tracking-wider">No Image</span>
                            </div>
                        @endif
                        
                        <!-- Category Badge overlay -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/90 dark:bg-gray-900/90 text-indigo-700 dark:text-indigo-400 backdrop-blur-sm shadow-sm">
                                {{ $product->category->nama_kategori }}
                            </span>
                        </div>

                        <!-- Stock Badge overlay -->
                        @if($product->jumlah_barang == 0)
                            <div class="absolute inset-0 bg-white/60 dark:bg-gray-900/60 backdrop-blur-[2px] z-20 flex items-center justify-center">
                                <span class="bg-red-600 text-white font-black px-6 py-2 rounded-full uppercase transform -rotate-12 outline shadow-xl border-4 border-white dark:border-gray-800">Terjual Habis</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $product->nama_barang }}</h3>
                        <div class="text-2xl font-black text-indigo-700 dark:text-indigo-400 mb-6 mt-auto">Rp {{ number_format($product->harga_barang, 0, ',', '.') }}</div>
                        
                        <div class="mt-auto">
                            <div class="flex items-center text-sm font-medium {{ $product->jumlah_barang == 0 ? 'text-red-500' : 'text-green-600 dark:text-green-400' }} mb-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg p-2 px-3 border border-gray-100 dark:border-gray-600">
                                @if($product->jumlah_barang > 0)
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Stok Tersedia: {{ $product->jumlah_barang }}
                                @else
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Stok Habis
                                @endif
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="flex gap-2 h-12">
                                    <div class="relative w-20">
                                        <input type="number" name="qty" value="1" min="1" max="{{ max(1, $product->jumlah_barang) }}" 
                                            class="w-full h-full text-center rounded-xl border-gray-200 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 font-bold bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white m-0"
                                            {{ $product->jumlah_barang == 0 ? 'disabled' : '' }}>
                                    </div>
                                    
                                    <button type="submit" 
                                            class="flex-1 h-full rounded-xl font-bold transition-all duration-200 flex items-center justify-center gap-2 shadow-sm
                                            {{ $product->jumlah_barang == 0 
                                                ? 'bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed border border-gray-200 dark:border-gray-600' 
                                                : 'bg-gray-900 dark:bg-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-500 text-white hover:shadow-md' }}"
                                            {{ $product->jumlah_barang == 0 ? 'disabled' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                        </svg>
                                        {{ $product->jumlah_barang == 0 ? 'Habis' : 'Tambah' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
