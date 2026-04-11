<x-admin-layout>
    <x-slot name="header">{{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori' }}</x-slot>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 max-w-2xl">
        <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $category->nama_kategori ?? '') }}" required
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-gray-900">
                @error('nama_kategori')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition-colors font-medium">Batal</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors shadow-sm">
                    {{ isset($category) ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
