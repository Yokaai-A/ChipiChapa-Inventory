<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout & Faktur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="lg:w-2/3">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors duration-200">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Isi Keranjang</h3>
                            <a href="{{ route('catalog') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium transition-colors">&larr; Lanjut Belanja</a>
                        </div>
                        
                        @if(count($cart) > 0)
                            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($cart as $id => $item)
                                <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 group">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 dark:text-white">{{ $item['name'] }}</h4>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Harga Satuan: Rp. {{ number_format($item['price'], 0, ',', '.') }}</div>
                                        <div class="text-indigo-600 font-bold mt-2">Subtotal: Rp. {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                                    </div>
                                    
                                    <div class="flex items-center gap-4 w-full sm:w-auto">
                                        <!-- Update Qty -->
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="w-20 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 py-1.5 text-sm">
                                            <button type="submit" class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/50 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">Update</button>
                                        </form>

                                        <!-- Remove -->
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 p-2 rounded-lg transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-400 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Keranjang Anda Kosong</h4>
                                <p class="text-gray-500 dark:text-gray-400 mb-6">Silakan lihat katalog barang kami untuk menambahkan item ke keranjang.</p>
                                <a href="{{ route('catalog') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors inline-block">Menuju Katalog</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="lg:w-1/3">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border-2 border-indigo-50 dark:border-gray-700 overflow-hidden sticky top-8 transition-colors duration-200">
                        <div class="p-6 bg-gradient-to-br from-indigo-500 to-purple-600 text-white">
                            <h3 class="text-lg font-bold mb-1">Ringkasan Pesanan</h3>
                            <p class="text-indigo-100 text-sm">Lengkapi data pengiriman</p>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-100 dark:border-gray-700">
                                <span class="text-gray-600 dark:text-gray-400">Total Harga</span>
                                <span class="text-2xl font-black text-gray-900 dark:text-white">Rp. {{ number_format($total_harga, 0, ',', '.') }}</span>
                            </div>

                            @if(count($cart) > 0)
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat Pengiriman</label>
                                    <textarea name="alamat_pengiriman" rows="3" required minlength="10" maxlength="100" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Minimal 10 karakter..."></textarea>
                                    @error('alamat_pengiriman')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Pos</label>
                                    <input type="text" name="kode_pos" required pattern="[0-9]{5}" maxlength="5" title="Harus 5 digit angka" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Contoh: 11480">
                                    @error('kode_pos')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white font-bold py-3.5 px-4 rounded-xl transition-transform hover:-translate-y-0.5 shadow-md flex justify-center items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                    </svg>
                                    Buat Faktur Sekarang
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
