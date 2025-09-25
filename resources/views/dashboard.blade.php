<x-app-layout>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 disabled:pointer-events-none disabled:opacity-50 shadow h-9 px-4 py-2 bg-black text-white dark:bg-white dark:text-black hover:bg-black/90 dark:hover:bg-white/90">
                Buat Proyek Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Grid Kartu Statistik Proyek --}}
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="border bg-card text-card-foreground rounded-lg shadow-sm">
                    <div class="p-6 flex flex-row items-center justify-between pb-2">
                        <h3 class="tracking-tight text-sm font-medium text-gray-500 dark:text-gray-400">Total Proyek</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 text-gray-400">
                           <path d="M21.11 4a1 1 0 0 0-1-1H3.89a1 1 0 0 0-1 1L2 20a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1Z"/>
                           <path d="M7 8v2"/><path d="M12 8v2"/><path d="M17 8v2"/>
                        </svg>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="text-2xl font-bold dark:text-white">{{ $totalProjects }}</div>
                        <p class="text-xs text-muted-foreground text-gray-500 mt-1">Proyek yang Anda kelola</p>
                    </div>
                </div>
                <div class="border bg-card text-card-foreground rounded-lg shadow-sm">
                    <div class="p-6 flex flex-row items-center justify-between pb-2">
                        <h3 class="tracking-tight text-sm font-medium text-gray-500 dark:text-gray-400">Proyek Aktif</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 text-gray-400">
                           <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="text-2xl font-bold dark:text-white">{{ $activeProjects }}</div>
                        <p class="text-xs text-muted-foreground text-gray-500 mt-1">Status "In Progress"</p>
                    </div>
                </div>
                <div class="border bg-card text-card-foreground rounded-lg shadow-sm">
                    <div class="p-6 flex flex-row items-center justify-between pb-2">
                        <h3 class="tracking-tight text-sm font-medium text-gray-500 dark:text-gray-400">Proyek Selesai</h3>
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 text-gray-400">
                           <path d="m9 11 3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                        </svg>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="text-2xl font-bold dark:text-white">{{ $completedProjects }}</div>
                        <p class="text-xs text-muted-foreground text-gray-500 mt-1">Telah mencapai deadline</p>
                    </div>
                </div>
                <div class="border bg-card text-card-foreground rounded-lg shadow-sm">
                    <div class="p-6 flex flex-row items-center justify-between pb-2">
                        <h3 class="tracking-tight text-sm font-medium text-gray-500 dark:text-gray-400">Total Tugas</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 text-gray-400">
                           <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                           <polyline points="14 2 14 8 20 8"/>
                           <line x1="16" y1="13" x2="8" y2="13"/>
                           <line x1="16" y1="17" x2="8" y2="17"/>
                           <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="text-2xl font-bold dark:text-white">{{ $totalTasks }}</div>
                        <p class="text-xs text-muted-foreground text-gray-500 mt-1">Di semua proyek Anda</p>
                    </div>
                </div>
            </div>

            <div class="border bg-card text-card-foreground rounded-lg shadow-sm">
                <div class="p-6">
                    <h3 class="font-semibold dark:text-white">Tugas Terbaru yang Ditambahkan</h3>
                    <p class="text-sm text-muted-foreground text-gray-500">5 tugas terakhir yang Anda buat.</p>
                </div>
                <div class="p-6 pt-0">
                    @forelse ($recentTasks as $task)
                        <div class="flex items-center py-3 {{ !$loop->last ? 'border-b dark:border-gray-700' : '' }}">
                            <div class="flex-grow">
                                <p class="font-medium dark:text-white">{{ $task->title }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    di Proyek: <a href="{{ route('projects.show', $task->project) }}" class="text-indigo-500 hover:underline">{{ $task->project->name }}</a>
                                </p>
                            </div>
                            <div class="text-sm text-gray-500">{{ $task->created_at->diffForHumans() }}</div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada tugas yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>