<x-admin-layout>
    <x-slot name="header">Daftar Barang</x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors duration-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">Katalog Barang</h2>
            <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors shadow-sm">Tambah Barang</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-500 dark:text-gray-300 text-sm">
                        <th class="p-4 font-medium">Foto</th>
                        <th class="p-4 font-medium">Nama Barang</th>
                        <th class="p-4 font-medium">Kategori</th>
                        <th class="p-4 font-medium">Harga</th>
                        <th class="p-4 font-medium">Stok</th>
                        <th class="p-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="p-4">
                            @if($product->foto_barang)
                                <img src="{{ asset('storage/' . $product->foto_barang) }}" class="w-16 h-16 object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                            @else
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 dark:text-gray-500 text-xs border border-gray-200 dark:border-gray-600">No Img</div>
                            @endif
                        </td>
                        <td class="p-4 text-gray-900 dark:text-white font-medium">{{ $product->nama_barang }}</td>
                        <td class="p-4 text-gray-600 dark:text-gray-300"><span class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 text-xs px-2 py-1 rounded">{{ $product->category->nama_kategori }}</span></td>
                        <td class="p-4 text-gray-900 dark:text-white font-medium">Rp. {{ number_format($product->harga_barang, 0, ',', '.') }}</td>
                        <td class="p-4">
                            <span class="{{ $product->jumlah_barang == 0 ? 'text-red-600 dark:text-red-400 font-bold' : 'text-green-600 dark:text-green-400 font-medium' }}">
                                {{ $product->jumlah_barang }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 px-3 py-1 rounded text-sm transition-colors">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 px-3 py-1 rounded text-sm transition-colors">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400">Belum ada barang di katalog.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>