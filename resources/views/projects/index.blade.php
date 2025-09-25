<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Proyek Saya') }}
            </h2>
            <a href="{{ route('projects.create') }}">
                <x-form.button type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Proyek Baru
                </x-form.button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800/50 dark:border dark:border-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 rounded-lg border border-green-200 dark:border-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    @forelse ($projects as $project)
                        <a href="{{ route('projects.show', $project) }}" class="block mb-4 p-5 border dark:border-slate-200 rounded-lg transition-all duration-300 hover:shadow-lg hover:border-indigo-500/50 dark:hover:bg-slate-800 dark:border-slate-700">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white">{{ $project->name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        Tenggat: {{ $project->due_date ? $project->due_date->format('d M Y') : 'Tidak ada' }}
                                    </p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="text-sm font-medium px-3 py-1 rounded-full {{ $project->status == 'Completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' }}">
                                        {{ $project->status }}
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 text-gray-400"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-12">
                             <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-gray-400"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                            <h3 class="mt-4 font-medium text-lg text-gray-800 dark:text-white">Belum Ada Proyek</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Mulai kelola pekerjaan Anda dengan membuat proyek pertama.</p>
                            <div class="mt-6">
                               <a href="{{ route('projects.create') }}">
                                    <x-form.button type="button">
                                        Buat Proyek Sekarang
                                    </x-form.button>
                                </a>
                            </div>
                        </div>
                    @endforelse
                    
                    <div class="mt-6">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>