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
                                    <div class="flex items-start justify-between">
                                        <p class="font-medium text-gray-900 dark:text-white {{ $task->is_completed ? 'line-through text-gray-500 dark:text-gray-400' : '' }}">
                                            {{ $task->title }}
                                        </p>
                                        
                                        <div class="flex-shrink-0 relative">
                                            <x-dropdown align="right" width="48">
                                                <x-slot name="trigger">
                                                    <button class="text-gray-400 hover:text-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
                                                    </button>
                                                </x-slot>
                        
                                                <x-slot name="content">
                                                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="To Do">
                                                        <x-dropdown-link :href="route('tasks.update', $task)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                            To Do
                                                        </x-dropdown-link>
                                                    </form>
                                                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="In Progress">
                                                        <x-dropdown-link :href="route('tasks.update', $task)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                            In Progress
                                                        </x-dropdown-link>
                                                    </form>
                                                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="Done">
                                                        <x-dropdown-link :href="route('tasks.update', $task)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                            Done
                                                        </x-dropdown-link>
                                                    </form>
                                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>
                                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-dropdown-link :href="route('tasks.destroy', $task)" onclick="event.preventDefault(); if(confirm('Anda yakin ingin menghapus tugas ini?')) this.closest('form').submit();" class="text-red-600">
                                                            Hapus
                                                        </x-dropdown-link>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Dibuat: {{ $task->created_at->format('d M') }}</p>
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