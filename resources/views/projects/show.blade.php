<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('projects.index') }}" class="hover:underline">Proyek Saya</a> / {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800/50 shadow-sm sm:rounded-lg p-6 mb-6 border dark:border-slate-700">
                 <form method="POST" action="{{ route('tasks.store', $project) }}">
                    @csrf
                    <div class="flex items-center space-x-2">
                        <x-form.input id="title" class="block w-full" type="text" name="title" placeholder="Tulis tugas baru di kolom 'To Do'..." required />
                        <x-form.button>{{ __('Tambah Tugas') }}</x-form.button>
                    </div>
                </form>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($columns as $status => $tasks)
                    <div class="bg-gray-100 dark:bg-slate-800/50 rounded-lg p-4">
                        <h3 class="font-bold text-lg text-gray-800 dark:text-gray-200 mb-4">{{ $status }} <span class="text-sm font-normal text-gray-500">({{ $tasks->count() }})</span></h3>

                        <div class="space-y-3">
                            @forelse ($tasks as $task)
                                <div class="bg-white dark:bg-slate-700 p-4 rounded-md shadow-sm border dark:border-slate-600">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $task->title }}</p>
                                    <div class="flex justify-between items-center mt-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat: {{ $task->created_at->format('d M') }}</p>
                                        </div>
                                </div>
                            @empty
                                <div class="text-center text-sm text-gray-500 dark:text-gray-400 py-4">
                                    Tidak ada tugas
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>