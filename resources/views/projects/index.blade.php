<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Proyek Saya') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Buat Proyek
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($projects as $project)
                    <a href="{{ route('projects.show', $project) }}" class="block bg-white dark:bg-slate-800/50 shadow-sm sm:rounded-lg border dark:border-slate-700 hover:border-indigo-500 transition">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $project->name }}</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($project->description, 100) }}</p>
                            
                            @if ($project->due_date)
                                <p class="mt-3 text-xs {{ now()->startOfDay()->diffInDays($project->due_date, false) < 3 ? 'text-red-500 font-semibold' : 'text-gray-500 dark:text-gray-300' }}">
                                    Jatuh tempo: {{ $project->due_date->format('d M Y') }}
                                </p>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Anda belum memiliki proyek. <a href="{{ route('projects.create') }}" class="text-indigo-500 hover:underline">Buat sekarang</a>.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</x-app-layout>