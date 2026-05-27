<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Rak Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('bookshelf.store') }}" method="POST" class="mb-6 flex gap-2">
                    @csrf
                    <x-text-input name="name" placeholder="Nama Rak" required class="flex-1" />
                    <x-text-input name="code" placeholder="Kode (misal: R01)" required class="w-32" />
                    <x-primary-button>Tambah Rak</x-primary-button>
                </form>

                <x-table>
                    <x-slot name="head">
                        <th class="p-3">Kode</th>
                        <th class="p-3">Nama Rak</th>
                        <th class="p-3">Aksi</th>
                    </x-slot>
                    <x-slot name="body">
                    @foreach ($bookshelves as $shelf)
                        <tr class="border-b">
                            <td class="p-3">{{ $shelf->code }}</td>
                            <td class="p-3">{{ $shelf->name }}</td>
                            <td class="p-3">
                                <div class="flex justify-center items-center gap-2">
                                    <x-primary-button 
                                        x-data="" 
                                        x-on:click.prevent="$dispatch('open-modal', 'edit-bookshelf-{{ $shelf->id }}')">
                                        Edit
                                    </x-primary-button>

                                    <form action="{{ route('bookshelf.destroy', $shelf->id) }}" method="POST" class="m-0">
                                        @csrf @method('DELETE')
                                        <x-danger-button onclick="return confirm('Yakin ingin hapus?')">Hapus</x-danger-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>

    @foreach ($bookshelves as $shelf)
    <x-modal name="edit-bookshelf-{{ $shelf->id }}" focusable>
        <form action="{{ route('bookshelf.update', $shelf->id) }}" method="POST" class="p-6">
            @csrf @method('PUT')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Edit Rak: {{ $shelf->name }}</h2>
            
            <div class="mt-4">
                <x-input-label value="Nama Rak" />
                <x-text-input name="name" value="{{ $shelf->name }}" class="w-full" required />
            </div>
            <div class="mt-4">
                <x-input-label value="Kode Rak" />
                <x-text-input name="code" value="{{ $shelf->code }}" class="w-full" required />
            </div>
            
            <div class="mt-6 flex justify-end gap-2">
                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                <x-primary-button>Simpan Perubahan</x-primary-button>
            </div>
        </form>
    </x-modal>
    @endforeach
</x-app-layout>