<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Proyek Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800/50 shadow-sm sm:rounded-lg border dark:border-slate-700">
                <div class="p-6">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div>
                            <x-form.label for="name" :value="__('Nama Proyek')" />
                            <x-form.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-form.label for="description" :value="__('Deskripsi')" />
                            <textarea name="description" id="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="mt-4">
                            <x-form.label for="due_date" :value="__('Tanggal Jatuh Tempo')" />
                            <x-form.input id="due_date" class="block mt-1 w-full" type="date" name="due_date" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-form.button>
                                {{ __('Simpan Proyek') }}
                            </x-form.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>