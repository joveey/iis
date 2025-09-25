<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Proyek Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="border bg-card text-card-foreground rounded-lg shadow-sm">
                <form method="POST" action="{{ route('projects.store') }}" class="p-6 space-y-6">
                    @csrf
                    
                    <div>
                        <x-form.label for="name" :value="__('Nama Proyek')" />
                        <x-form.input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.label for="description" :value="__('Deskripsi (Opsional)')" />
                        <textarea id="description" name="description" rows="4" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mt-2 dark:text-gray-300">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.label for="due_date" :value="__('Tenggat Waktu (Opsional)')" />
                        <x-form.input id="due_date" class="block mt-2 w-full" type="date" name="due_date" :value="old('due_date')" />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-form.button>{{ __('Simpan Proyek') }}</x-form.button>
                        <a href="{{ route('projects.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>